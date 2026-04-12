<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function show()
    {
        $user   = Auth::user();
        $idUser = $user->id_user;

        \App\Models\Transaksi::where('id_user', $idUser)
            ->where('status_peminjam', 'pinjam')
            ->where('tanggal_batas', '<', \Carbon\Carbon::today())
            ->update(['status_peminjam' => 'kadaluwarsa']);

        $totalPeminjaman    = \App\Models\Transaksi::where('id_user', $idUser)->count();
        $sedangDipinjam     = \App\Models\Transaksi::where('id_user', $idUser)->where('status_peminjam', 'pinjam')->count();
        $sudahDikembalikan  = \App\Models\Transaksi::where('id_user', $idUser)->where('status_peminjam', 'kembali')->count();

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
                if ($item->ebook) {
                    $item->ebook->judul     = $item->ebook->judul_buku;
                    $item->ebook->pengarang = $item->ebook->pengarang;
                }
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

        $user->name  = $validated['name'];
        $user->email = $validated['email'];
        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']);
        }
        $user->save();

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

    public function uploadFoto(Request $request)
    {
        try {
            $request->validate([
                'foto' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            ]);

            $user    = Auth::user();
            $anggota = $user->anggota;

            // Hapus foto lama dari Supabase (di folder images/foto)
            if ($anggota && $anggota->foto) {
                try {
                    Storage::disk('supabase')->delete('images/foto/' . $anggota->foto);
                } catch (\Exception $e) {
                    // Abaikan jika file tidak ditemukan
                }
            }

            // Upload ke Supabase di folder images/foto
            $file = $request->file('foto');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            
            // Simpan ke Supabase bucket di path 'images/foto'
            $path = $file->storeAs('images/foto', $filename, 'supabase');
            
            if (!$path) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menyimpan file ke Supabase'
                ], 500);
            }

            // Update database (simpan hanya nama file, tanpa path)
            if ($anggota) {
                $anggota->foto = $filename;
                $anggota->save();
            } else {
                $anggota = \App\Models\Anggota::create([
                    'id_user' => $user->id_user,
                    'foto'    => $filename,
                    'nama'    => $user->name,
                ]);
            }

            // URL publik dari Supabase (dengan path lengkap)
            $url = Storage::disk('supabase')->url('images/foto/' . $filename);

            return response()->json([
                'success' => true,
                'url'     => $url,
                'filename'=> $filename,
                'message' => 'Foto profil berhasil diperbarui!',
            ]);

        } catch (\Exception $e) {
            \Log::error('Upload foto error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}