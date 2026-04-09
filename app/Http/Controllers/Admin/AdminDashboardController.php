<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EBook;
use App\Models\Kategori;
use App\Models\Transaksi;
use App\Models\User;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // ── Stats utama ──────────────────────────────────────────
        $totalEbook    = EBook::count();
        $totalAnggota  = User::where('role', 'anggota')->count();
        $totalKategori = Kategori::count();

        // "Sedang Dipinjam" = transaksi dengan status 'pinjam'
        $sedangDipinjam = Transaksi::where('status_peminjam', 'pinjam')->count();

        // ── Mini stats ────────────────────────────────────────────
        $totalStok    = EBook::sum('jumlah_ebook');
        $stokTinggi   = EBook::where('jumlah_ebook', '>', 10)->count();
        $ebookAktif   = EBook::whereNotNull('file_ebook')->count();
        $bukuBaru     = EBook::where('created_at', '>=', now()->subDays(30))->count();
        $stokHabis    = EBook::where('jumlah_ebook', 0)->count();

        // ── Chart: distribusi stok ────────────────────────────────
        $chartStokTinggi  = EBook::where('jumlah_ebook', '>', 10)->count();
        $chartStokRendah  = EBook::whereBetween('jumlah_ebook', [1, 10])->count();
        $chartStokHabis   = EBook::where('jumlah_ebook', 0)->count();

        // ── Kategori distribusi ───────────────────────────────────
        $categories = Kategori::withCount('ebooks')
            ->orderBy('ebooks_count', 'desc')
            ->take(5)
            ->get();

        // ── Aktivitas terbaru (buku baru ditambahkan) ─────────────
        $recentBooks = EBook::with('kategori')
            ->latest('created_at')
            ->take(5)
            ->get();

        // ── Tabel: peminjaman aktif (sedang dipinjam) ─────────────
        $peminjamanAktif = Transaksi::with(['user', 'ebook'])
            ->where('status_peminjam', 'pinjam')
            ->orderBy('tanggal_batas', 'asc')   // yang paling mepet tenggat di atas
            ->take(5)
            ->get();

        // ── Tabel: buku terbaru ───────────────────────────────────
        $latestBooks = EBook::with('kategori')
            ->latest('id_buku')
            ->take(5)
            ->get();

        // ── Alert: transaksi lewat tenggat (kadaluwarsa otomatis) ─
        $lewatTenggat = Transaksi::where('status_peminjam', 'pinjam')
            ->where('tanggal_batas', '<', Carbon::today())
            ->count();

        return view('admin.dashboard', compact(
            'totalEbook',
            'totalAnggota',
            'totalKategori',
            'sedangDipinjam',
            'totalStok',
            'stokTinggi',
            'ebookAktif',
            'bukuBaru',
            'stokHabis',
            'chartStokTinggi',
            'chartStokRendah',
            'chartStokHabis',
            'categories',
            'recentBooks',
            'peminjamanAktif',
            'latestBooks',
            'lewatTenggat'
        ));
    }
}