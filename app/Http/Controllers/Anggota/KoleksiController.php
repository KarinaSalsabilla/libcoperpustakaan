<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\EBook;
use App\Models\Kategori;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class KoleksiController extends Controller
{
    public function index(Request $request)
    {
        $query = EBook::with(['kategori'])->latest();

        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('judul_buku', 'like', "%{$search}%")
                  ->orWhere('pengarang', 'like', "%{$search}%")
                  ->orWhere('penerbit', 'like', "%{$search}%")
                  ->orWhereHas('kategori', fn($k) => $k->where('nama_kategori', 'like', "%{$search}%"));
            });
        }

        if ($request->filled('kategori')) {
            $query->where('id_kategori', $request->kategori);
        }

        $ebooks    = $query->paginate(12)->withQueryString();
        $kategoris = Kategori::orderBy('nama_kategori')->get();

        $sedangDipinjam = Transaksi::where('id_user', Auth::id())
            ->where('status_peminjam', 'pinjam')
            ->pluck('id_buku')
            ->toArray();

        return view('anggota.koleksi.index', compact('ebooks', 'kategoris', 'sedangDipinjam'));
    }

    public function pinjam(Request $request, EBook $ebook)
    {
        $userId = Auth::id();

        // Cegah jika user ini sudah meminjam buku yang sama dan belum dikembalikan
        $sudahPinjam = Transaksi::where('id_user', $userId)
            ->where('id_buku', $ebook->id_buku)
            ->where('status_peminjam', 'pinjam')
            ->exists();

        if ($sudahPinjam) {
            return back()->with('error', 'Kamu sedang meminjam buku ini. Kembalikan dulu sebelum meminjam lagi.');
        }

        // ✅ Cek stok tersedia
        if ($ebook->jumlah_ebook <= 0) {
            return back()->with('error', 'Stok buku sedang habis. Silakan tunggu hingga ada anggota lain yang mengembalikan.');
        }

        $request->validate([
            'durasi' => 'nullable|integer|min:1|max:30',
        ]);

        $durasi = $request->input('durasi', 14);

        // ✅ Kurangi stok
        $ebook->decrement('jumlah_ebook');

        // Buat transaksi
        Transaksi::create([
            'id_user'         => $userId,
            'id_buku'         => $ebook->id_buku,
            'tanggal_pinjam'  => Carbon::today(),
            'tanggal_batas'   => Carbon::today()->addDays($durasi),
            'status_peminjam' => 'pinjam',
        ]);

        return back()->with('success', "Berhasil meminjam \"{$ebook->judul_buku}\"! Batas kembali: " . Carbon::today()->addDays($durasi)->format('d M Y'));
    }
}