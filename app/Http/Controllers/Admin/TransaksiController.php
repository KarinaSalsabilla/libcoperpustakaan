<?php

namespace App\Http\Controllers\Admin;

use App\Models\AppSetting;
use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Models\EBook;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaksi::with(['user', 'ebook'])->latest('tanggal_pinjam');

        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->whereHas('ebook', fn($q) => $q->where('judul_buku', 'like', "%{$request->q}%"))
                  ->orWhereHas('user',  fn($q) => $q->where('name', 'like', "%{$request->q}%"));
            });
        }

        if ($request->filled('status')) {
            $query->where('status_peminjam', $request->status);
        }

        $transaksis = $query->paginate(15)->withQueryString();

        return view('admin.transaksi.index', compact('transaksis'));
    }

  public function create()
{
    $users  = User::where('role', 'anggota')->orderBy('name')->get();
    $ebooks = EBook::where('jumlah_ebook', '>', 0)->orderBy('judul_buku')->get();

    // Kirim durasi ke view supaya bisa prefill tanggal_batas
    $durasi = (int) AppSetting::get('durasi_pinjam', 7);

    return view('admin.transaksi.create', compact('users', 'ebooks', 'durasi'));
}

 public function store(Request $request)
{
    $request->validate([
        'id_user'        => 'required|exists:users,id_user',
        'id_buku'        => 'required|exists:e_books,id_buku',
        'tanggal_pinjam' => 'required|date',
        'tanggal_batas'  => 'required|date|after_or_equal:tanggal_pinjam',
    ]);

    // Ambil setting
    $maksPinjam = (int) AppSetting::get('maks_pinjam', 3);
    $durasi     = (int) AppSetting::get('durasi_pinjam', 7);

    // Cek jumlah buku yang sedang dipinjam user ini
    $sedangDipinjam = Transaksi::where('id_user', $request->id_user)
                               ->where('status_peminjam', 'pinjam')
                               ->count();

    if ($sedangDipinjam >= $maksPinjam) {
        return back()
            ->withInput()
            ->with('error', "Anggota ini sudah meminjam {$sedangDipinjam} buku (maks. {$maksPinjam}).");
    }

    $ebook = EBook::findOrFail($request->id_buku);

    if ($ebook->jumlah_ebook <= 0) {
        return back()
            ->withInput()
            ->with('error', "Stok buku \"{$ebook->judul_buku}\" sudah habis.");
    }

    // Hitung tanggal_batas otomatis dari durasi setting
    $tanggalBatas = Carbon::parse($request->tanggal_pinjam)->addDays($durasi)->toDateString();

    $ebook->decrement('jumlah_ebook');

    Transaksi::create([
        'id_user'         => $request->id_user,
        'id_buku'         => $request->id_buku,
        'tanggal_pinjam'  => $request->tanggal_pinjam,
        'tanggal_batas'   => $tanggalBatas, // otomatis dari setting
        'status_peminjam' => 'pinjam',
    ]);

    return redirect()
        ->route('admin.transaksi.index')
        ->with('success', "Transaksi berhasil ditambahkan. Batas kembali: " . 
            Carbon::parse($tanggalBatas)->format('d M Y'));
}

    public function edit(Transaksi $transaksi)
    {
        return view('admin.transaksi.edit', compact('transaksi'));
    }

    public function update(Request $request, Transaksi $transaksi)
    {
        $request->validate([
            'tanggal_batas'   => 'required|date',
            'status_peminjam' => 'required|in:aktif,pinjam,kadaluwarsa',
        ]);

        $statusLama = $transaksi->status_peminjam;
        $statusBaru = $request->status_peminjam;

        // pinjam → aktif/kadaluwarsa: kembalikan stok
        if ($statusLama === 'pinjam' && in_array($statusBaru, ['aktif', 'kadaluwarsa'])) {
            $transaksi->ebook->increment('jumlah_ebook');
        }

        // aktif/kadaluwarsa → pinjam: kurangi stok
        if (in_array($statusLama, ['aktif', 'kadaluwarsa']) && $statusBaru === 'pinjam') {
            if ($transaksi->ebook->jumlah_ebook <= 0) {
                return back()->with('error', 'Stok buku sudah habis, tidak bisa mengubah status kembali ke dipinjam.');
            }
            $transaksi->ebook->decrement('jumlah_ebook');
        }

        $transaksi->update([
            'tanggal_batas'   => $request->tanggal_batas,
            'status_peminjam' => $statusBaru,
        ]);

        return redirect()
            ->route('admin.transaksi.index')
            ->with('success', 'Transaksi berhasil diperbarui.');
    }

    /**
     * Admin kembalikan buku manual.
     */
    public function kembalikan(Transaksi $transaksi)
    {
        if ($transaksi->status_peminjam !== 'pinjam') {
            return back()->with('error', 'Buku ini sudah dikembalikan sebelumnya.');
        }

        $transaksi->ebook->increment('jumlah_ebook');
        $transaksi->update(['status_peminjam' => 'aktif']);

        return back()->with('success', "Buku \"{$transaksi->ebook->judul_buku}\" berhasil dikembalikan.");
    }

    public function destroy(Transaksi $transaksi)
    {
        // Jika masih dipinjam, kembalikan stok dulu
        if ($transaksi->status_peminjam === 'pinjam') {
            $transaksi->ebook->increment('jumlah_ebook');
        }

        $transaksi->delete();
        return back()->with('success', 'Transaksi berhasil dihapus.');
    }
}