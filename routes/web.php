<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\EBookController;
use App\Http\Controllers\Admin\GenreController;
use App\Http\Controllers\Admin\AnggotaController;
use App\Http\Controllers\Admin\TransaksiController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Anggota\KoleksiController;
use App\Http\Controllers\Admin\PengaturanController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| PUBLIC
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    $books = \App\Models\EBook::with('kategori')
        ->latest('id_buku')
        ->take(12)
        ->get();
    $kategoris = \App\Models\Kategori::all();
    return view('home.index', compact('books', 'kategoris'));
});

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/login',    [AuthController::class, 'formLogin'])->name('login');
Route::post('/login',   [AuthController::class, 'login']);
Route::post('/logout',  [AuthController::class, 'logout']);
Route::get('/register', [AuthController::class, 'formRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

/*
|--------------------------------------------------------------------------
| ANGGOTA (wajib login)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])
    ->prefix('anggota')
    ->name('anggota.')
    ->group(function () {

        // DASHBOARD
        Route::get('/', function () {
            $user   = auth()->user();
            $idUser = $user->id_user;

            // Auto-update kadaluwarsa
            \App\Models\Transaksi::where('id_user', $idUser)
                ->where('status_peminjam', 'pinjam')
                ->where('tanggal_batas', '<', \Carbon\Carbon::today())
                ->update(['status_peminjam' => 'kadaluwarsa']);

            $books = \App\Models\EBook::with('kategori')
                ->orderBy('id_buku', 'desc')
                ->paginate(12);

            $kategoris = \App\Models\Kategori::all();

            $activeLoans = \App\Models\Transaksi::with('ebook')
                ->where('id_user', $idUser)
                ->where('status_peminjam', 'pinjam')
                ->orderBy('tanggal_batas', 'asc')
                ->get();

            $historyLoans = \App\Models\Transaksi::with('ebook')
                ->where('id_user', $idUser)
                ->whereIn('status_peminjam', ['aktif', 'kadaluwarsa'])
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();

            $totalPeminjaman = \App\Models\Transaksi::where('id_user', $idUser)->count();
            $sedangDipinjam  = $activeLoans->count();
            $selesaiDibaca   = \App\Models\Transaksi::where('id_user', $idUser)
                ->where('status_peminjam', 'aktif')
                ->count();

            return view('anggota.dashboard_anggota', compact(
                'books',
                'kategoris',
                'activeLoans',
                'historyLoans',
                'totalPeminjaman',
                'sedangDipinjam',
                'selesaiDibaca'
            ));
        })->name('dashboard');

        // BUKU
        Route::get('/buku',              [EBookController::class, 'index'])->name('buku.index');
        Route::get('/buku/{id}',         [EBookController::class, 'showAnggota'])->name('buku.show');
        Route::post('/buku/{id}/pinjam', [PeminjamanController::class, 'store'])->name('buku.pinjam');

        // KOLEKSI
        Route::get('/koleksi',                 [KoleksiController::class, 'index'])->name('koleksi.index');
        Route::post('/koleksi/{ebook}/pinjam', [KoleksiController::class, 'pinjam'])->name('koleksi.pinjam');

        // PEMINJAMAN & RIWAYAT
        Route::get('/peminjaman',                  [PeminjamanController::class, 'index'])->name('peminjaman.index');
        Route::post('/peminjaman/{id}/kembalikan', [PeminjamanController::class, 'kembalikan'])->name('kembalikan');
        Route::get('/riwayat',                     [PeminjamanController::class, 'riwayatSaya'])->name('riwayat_saya');

        // KOLEKSI SAYA
        Route::get('/koleksi-saya', [EBookController::class, 'koleksiSaya'])->name('koleksi_saya');

        // PROFILE
        Route::get('/profile',       [ProfileController::class, 'show'])->name('profile.show');
        Route::put('/profile',       [ProfileController::class, 'update'])->name('profile.update');
        Route::post('/profile/foto', [ProfileController::class, 'uploadFoto'])->name('profile.uploadFoto');
    });

/*
|--------------------------------------------------------------------------
| ADMIN (login + role admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // DASHBOARD ✅ sekarang pakai controller, bukan closure
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

        // KATEGORI
        Route::resource('kategori', KategoriController::class);

        // GENRE
        Route::resource('genre', GenreController::class)->except(['show']);

        // ANGGOTA (RESOURCE + TAMBAHAN ROUTE FOTO)
        Route::resource('anggota', AnggotaController::class)->except(['create', 'store']);
        
        // ✅ TAMBAHKAN ROUTE UNTUK FOTO ANGGOTA
        Route::post('/anggota/{id}/upload-foto', [AnggotaController::class, 'uploadFoto'])->name('anggota.upload-foto');
        Route::delete('/anggota/{id}/delete-foto', [AnggotaController::class, 'deleteFoto'])->name('anggota.delete-foto');

        // TRANSAKSI
        Route::resource('transaksi', TransaksiController::class)->except(['show']);

        // Kembalikan buku (POST khusus)
        Route::post('/transaksi/{transaksi}/kembalikan', [TransaksiController::class, 'kembalikan'])
            ->name('transaksi.kembalikan');

        // LAPORAN
        Route::get('/laporan',        [LaporanController::class, 'index'])->name('laporan.index');
        Route::get('/laporan/export', [LaporanController::class, 'exportExcel'])->name('laporan.export');

        // PENGATURAN
        Route::get('/pengaturan',          [PengaturanController::class, 'index'])->name('pengaturan.index');
        Route::put('/pengaturan/password', [PengaturanController::class, 'updatePassword'])->name('pengaturan.password');
        Route::put('/pengaturan/aplikasi', [PengaturanController::class, 'updateAplikasi'])->name('pengaturan.aplikasi');
        Route::put('/pengaturan/tema',     [PengaturanController::class, 'updateTema'])->name('pengaturan.tema');

        // KARYA
        Route::get('/karya', function () {
            return view('admin.karya');
        })->name('karya.index');

        // BUKU
        Route::get('/buku',           [EBookController::class, 'adminIndex'])->name('buku.index');
        Route::get('/buku/create',    [EBookController::class, 'create'])->name('buku.create');
        Route::post('/buku',          [EBookController::class, 'store'])->name('buku.store');
        Route::get('/buku/{id}/edit', [EBookController::class, 'edit'])->name('buku.edit');
        Route::put('/buku/{id}',      [EBookController::class, 'update'])->name('buku.update');
        Route::delete('/buku/{id}',   [EBookController::class, 'destroy'])->name('buku.destroy');
    });

Route::get('/debug-disk', function () {
    $book = DB::table('e_books')->first();
    return [
        'filesystem_disk' => config('filesystems.default'),
        'cover_path'      => $book->cover ?? 'null',
        'storage_url'     => $book->cover ? Storage::url($book->cover) : 'null',
    ];
});