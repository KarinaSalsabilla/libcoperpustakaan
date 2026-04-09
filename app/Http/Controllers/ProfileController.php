<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    /**
     * Tampilkan halaman profil anggota.
     */
    public function show()
    {
        $user   = Auth::user();
        $idUser = $user->id_user;

        // Auto-update status kadaluwarsa dulu
        \App\Models\Transaksi::where('id_user', $idUser)
            ->where('status_peminjam', 'pinjam')
            ->where('tanggal_batas', '<', \Carbon\Carbon::today())
            ->update(['status_peminjam' => 'kadaluwarsa']);

        // Statistik
        $totalPeminjaman    = \App\Models\Transaksi::where('id_user', $idUser)->count();
        $sedangDipinjam     = \App\Models\Transaksi::where('id_user', $idUser)->where('status_peminjam', 'pinjam')->count();
        $sudahDikembalikan  = \App\Models\Transaksi::where('id_user', $idUser)->where('status_peminjam', 'kembali')->count();

        // 5 aktivitas terakhir dengan relasi ebook
        $riwayat = \App\Models\Transaksi::with('ebook')
            ->where('id_user', $idUser)
            ->orderByDesc('created_at')
            ->limit(5)
            ->get()
            ->map(function ($item) {
                $item->status = match($item->status_peminjam) {
                    'pinjam'      => 'aktif',
                    'kembali'     => 'selesai',
                    'kadaluwarsa' => 'terlambat',
                    default       => $item->status_peminjam,
                };
                $item->tgl_pinjam  = $item->tanggal_pinjam;
                $item->tgl_kembali = $item->tanggal_batas;
                // Alias nama kolom buku supaya template $item->buku->judul tetap jalan
                if ($item->ebook) {
                    $item->ebook->judul     = $item->ebook->judul_buku;
                    $item->ebook->pengarang = $item->ebook->pengarang;
                }
                // Buat virtual property ->buku yang menunjuk ke ebook
                $item->setRelation('buku', $item->ebook);
                return $item;
            });

        return view('anggota.profile.show', compact(
            'totalPeminjaman',
            'sedangDipinjam',
            'sudahDikembalikan',
            'riwayat'
        ));
    }

    /**
     * Update nama, email, dan/atau password.
     */
    public function update(Request $request)
{
    $user = Auth::user();

    $rules = [
        'name'          => ['required', 'string', 'max:255'],
        'email'         => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id_user . ',id_user'],
        'nohp'          => ['nullable', 'string', 'max:15'],
        'kota'          => ['nullable', 'string', 'max:20'],
        'jenis_kelamin' => ['nullable', 'in:L,P'],
        'agama'         => ['nullable', 'string', 'max:10'],
        'tempat_lahir'  => ['nullable', 'string', 'max:30'],
        'tgl_lahir'     => ['nullable', 'date'],
    ];

    if ($request->filled('password')) {
        $rules['password'] = ['required', 'confirmed', Password::min(8)];
    }

    $validated = $request->validate($rules);

    // Update tabel users
    $user->name  = $validated['name'];
    $user->email = $validated['email'];
    if ($request->filled('password')) {
        $user->password = Hash::make($validated['password']);
    }
    $user->save();

    // Update atau buat record di tabel anggota
    \App\Models\Anggota::updateOrCreate(
        ['id_user' => $user->id_user],
        [
            'nama'          => $validated['name'],
            'nohp'          => $request->nohp,
            'kota'          => $request->kota,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama'         => $request->agama,
            'tempat_lahir'  => $request->tempat_lahir,
            'tgl_lahir'     => $request->tgl_lahir,
        ]
    );

    return redirect()->route('anggota.profile.show')
        ->with('success', 'Profil berhasil diperbarui!');
}
    /**
     * Upload foto profil — disimpan permanen di storage.
     * Mengembalikan JSON supaya JS bisa preview tanpa reload.
     */
    public function uploadFoto(Request $request)
    {
        $request->validate([
            'foto' => ['required', 'image', 'mimes:jpeg,png,webp', 'max:2048'],
        ]);

        $user    = Auth::user();
        $anggota = $user->anggota; // relasi hasOne ke tabel anggota

        // Hapus foto lama kalau ada
        if ($anggota && $anggota->foto) {
            Storage::disk('public')->delete('foto/' . $anggota->foto);
        }

        // Simpan foto baru
        $filename = $request->file('foto')->store('foto', 'public');
        $filename = basename($filename); // hanya nama file

        // Simpan ke tabel anggota (atau buat record baru)
        if ($anggota) {
            $anggota->foto = $filename;
            $anggota->save();
        } else {
            \App\Models\Anggota::create([
                'id_user' => $user->id_user,
                'foto'    => $filename,
            ]);
        }

        // URL publik yang akan dipakai JS untuk update src gambar
        $url = asset('storage/foto/' . $filename);

        return response()->json([
            'success' => true,
            'url'     => $url,
            'message' => 'Foto profil berhasil diperbarui!',
        ]);
    }
}