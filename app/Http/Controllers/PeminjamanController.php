<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\EBook;
use App\Models\AppSetting;
use Carbon\Carbon;

class PeminjamanController extends Controller
{
    /**
     * Auto-kembalikan semua buku yang sudah lewat tanggal batas.
     * Dipanggil di awal setiap method yang butuh data akurat.
     */
    private function autoKembalikan($idUser = null)
    {
        $query = Transaksi::where('status_peminjam', 'pinjam')
            ->where('tanggal_batas', '<', Carbon::today());

        if ($idUser) {
            $query->where('id_user', $idUser);
        }

        $query->each(function ($transaksi) {
            if ($transaksi->ebook) {
                $transaksi->ebook->increment('jumlah_ebook');
            }
            $transaksi->update(['status_peminjam' => 'aktif']);
        });
    }

    public function index()
    {
        return view('anggota.peminjaman.index');
    }

    /**
     * Anggota meminjam buku.
     * Route: POST /anggota/buku/{id}/pinjam
     */
    public function store(Request $request, $id)
    {
        $idUser = auth()->user()->id_user;
        $ebook  = EBook::findOrFail($id);

        // Jalankan auto-kembalikan dulu sebelum cek stok/status
        $this->autoKembalikan();

        // 1. Cek sudah pinjam buku ini dan belum dikembalikan
        $sudahPinjam = Transaksi::where('id_user', $idUser)
            ->where('id_buku', $id)
            ->where('status_peminjam', 'pinjam')
            ->exists();

        if ($sudahPinjam) {
            return back()->with('error', 'Kamu sudah meminjam buku ini.');
        }

        // 2. Cek maks. pinjam dari setting
        $maksPinjam = (int) AppSetting::get('maks_pinjam', 3);
        $sedangDipinjam = Transaksi::where('id_user', $idUser)
                                    ->where('status_peminjam', 'pinjam')
                                    ->count();

        if ($sedangDipinjam >= $maksPinjam) {
            return back()->with('error', "Kamu sudah meminjam {$sedangDipinjam} buku. Maksimal {$maksPinjam} buku sekaligus.");
        }

        // 3. Cek stok tersedia
        if ($ebook->jumlah_ebook <= 0) {
            return back()->with('error', 'Stok buku sedang habis. Silakan tunggu hingga ada anggota lain yang mengembalikan.');
        }

        // 4. Kurangi stok
        $ebook->decrement('jumlah_ebook');

        // 5. Simpan transaksi — durasi dari setting
        $durasi = (int) AppSetting::get('durasi_pinjam', 7);

        Transaksi::create([
            'id_user'         => $idUser,
            'id_buku'         => $id,
            'tanggal_pinjam'  => Carbon::today(),
            'tanggal_batas'   => Carbon::today()->addDays($durasi),
            'status_peminjam' => 'pinjam',
        ]);

        return back()->with('success', "Buku berhasil dipinjam! Masa pinjam {$durasi} hari.");
    }

    /**
     * Anggota mengembalikan buku secara manual.
     * Route: POST /anggota/peminjaman/{id}/kembalikan
     */
    public function kembalikan($id)
    {
        $transaksi = Transaksi::where('id_peminjam', $id)
            ->where('id_user', auth()->user()->id_user)
            ->firstOrFail();

        if ($transaksi->status_peminjam !== 'pinjam') {
            return redirect()
                ->route('anggota.peminjaman.index')
                ->with('error', 'Buku ini sudah dikembalikan sebelumnya.');
        }

        if ($transaksi->ebook) {
            $transaksi->ebook->increment('jumlah_ebook');
        }

        $transaksi->update(['status_peminjam' => 'aktif']);

        return redirect()
            ->route('anggota.peminjaman.index')
            ->with('success', "Buku \"{$transaksi->ebook->judul_buku}\" berhasil dikembalikan.");
    }

    /**
     * Riwayat peminjaman anggota.
     * Route: GET /anggota/riwayat
     */
    public function riwayatSaya()
    {
        $idUser = auth()->user()->id_user;

        $this->autoKembalikan($idUser);

        $loans = Transaksi::with(['ebook.kategori'])
            ->where('id_user', $idUser)
            ->orderByDesc('tanggal_pinjam')
            ->paginate(15);

        $totalPeminjaman = Transaksi::where('id_user', $idUser)->count();
        $totalAktif      = Transaksi::where('id_user', $idUser)->where('status_peminjam', 'pinjam')->count();
        $totalSelesai    = Transaksi::where('id_user', $idUser)->where('status_peminjam', 'aktif')->count();

        return view('anggota.riwayat_saya', compact(
            'loans',
            'totalPeminjaman',
            'totalAktif',
            'totalSelesai'
        ));
    }
}