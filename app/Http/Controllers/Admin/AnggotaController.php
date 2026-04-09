<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Query dengan join yang benar
        $query = DB::table('anggota')
            ->join('users', 'anggota.id_user', '=', 'users.id_user')
            ->select('anggota.*', 'users.email', 'users.created_at as user_created_at');

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('anggota.nama', 'LIKE', "%{$search}%")
                    ->orWhere('anggota.nohp', 'LIKE', "%{$search}%")
                    ->orWhere('anggota.kota', 'LIKE', "%{$search}%")
                    ->orWhere('users.email', 'LIKE', "%{$search}%");
            });
        }

        // Filter by gender
        if ($request->filled('jenis_kelamin')) {
            $query->where('anggota.jenis_kelamin', $request->jenis_kelamin);
        }

        // Filter by city
        if ($request->filled('kota')) {
            $query->where('anggota.kota', $request->kota);
        }

        $anggotas = $query->orderBy('anggota.id_user', 'desc')->paginate(10);

        // Statistics
        $totalAnggota = DB::table('anggota')->count();
        $totalPerempuan = DB::table('anggota')->where('jenis_kelamin', 'P')->count();
        $totalLakiLaki = DB::table('anggota')->where('jenis_kelamin', 'L')->count();
        $anggotaBaru = DB::table('users')
            ->where('role', 'anggota')
            ->where('created_at', '>=', now()->subDays(30))
            ->count();

        // Get unique cities for filter
        $kotaList = DB::table('anggota')
            ->whereNotNull('kota')
            ->where('kota', '!=', '')
            ->distinct()
            ->pluck('kota')
            ->sort();

        return view('admin.anggota.index', compact(
            'anggotas',
            'totalAnggota',
            'totalPerempuan',
            'totalLakiLaki',
            'anggotaBaru',
            'kotaList'
        ));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $anggota = \App\Models\Anggota::with('user')->findOrFail($id);

        $totalPeminjaman = \App\Models\Transaksi::where('id_user', $id)->count();

        $riwayat = \App\Models\Transaksi::with('ebook')
            ->where('id_user', $id)
            ->orderByDesc('created_at')
            ->take(10)
            ->get();

        return view('admin.anggota.show', compact('anggota', 'totalPeminjaman', 'riwayat'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $anggota = DB::table('anggota')
            ->join('users', 'anggota.id_user', '=', 'users.id_user')
            ->where('anggota.id_user', $id)
            ->select('anggota.*', 'users.email')
            ->first();

        if (!$anggota) {
            abort(404, 'Anggota tidak ditemukan');
        }

        return view('admin.anggota.edit', compact('anggota'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($id, 'id_user')],
            'password' => 'nullable|min:8',
            'nama' => 'required|max:40',
            'nohp' => 'nullable|max:15',
            'jenis_kelamin' => 'nullable|in:L,P',
            'agama' => 'nullable|max:10',
            'tempat_lahir' => 'nullable|max:30',
            'tgl_lahir' => 'nullable|date',
            'kota' => 'nullable|max:20',
        ]);

        DB::beginTransaction();
        try {
            // Update users table
            $userData = [
                'email' => $request->email,
                'updated_at' => now(),
            ];

            // Only update password if provided
            if ($request->filled('password')) {
                $userData['password'] = Hash::make($request->password);
            }

            DB::table('users')
                ->where('id_user', $id)
                ->update($userData);

            // Update anggota table
            DB::table('anggota')
                ->where('id_user', $id)
                ->update([
                    'nama' => $request->nama,
                    'nohp' => $request->nohp,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'agama' => $request->agama,
                    'tempat_lahir' => $request->tempat_lahir,
                    'tgl_lahir' => $request->tgl_lahir,
                    'kota' => $request->kota,
                ]);

            DB::commit();

            return redirect()->route('admin.anggota.index')
                ->with('success', 'Data anggota berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            // Delete from anggota table first (foreign key)
            DB::table('anggota')->where('id_user', $id)->delete();

            // Then delete from users table
            DB::table('users')->where('id_user', $id)->delete();

            DB::commit();

            return redirect()->route('admin.anggota.index')
                ->with('success', 'Anggota berhasil dihapus!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menghapus anggota: ' . $e->getMessage());
        }
    }

    /**
     * Show user profile form (untuk user biasa)
     */
    public function showProfile()
    {
        $anggota = DB::table('anggota')
            ->join('users', 'anggota.id_user', '=', 'users.id_user')
            ->where('anggota.id_user', auth()->user()->id_user)
            ->select('anggota.*', 'users.email')
            ->first();

        if (!$anggota) {
            abort(404, 'Data profile tidak ditemukan');
        }

        return view('profile.edit', compact('anggota'));
    }

    /**
     * Update user profile (untuk user biasa)
     */
    public function updateProfile(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:40',
            'nohp' => 'nullable|max:15',
            'jenis_kelamin' => 'nullable|in:L,P',
            'agama' => 'nullable|max:10',
            'tempat_lahir' => 'nullable|max:30',
            'tgl_lahir' => 'nullable|date',
            'kota' => 'nullable|max:20',
        ]);

        DB::beginTransaction();
        try {
            // Update tabel anggota
            DB::table('anggota')
                ->where('id_user', auth()->user()->id_user)
                ->update([
                    'nama' => $request->nama,
                    'nohp' => $request->nohp,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'agama' => $request->agama,
                    'tempat_lahir' => $request->tempat_lahir,
                    'tgl_lahir' => $request->tgl_lahir,
                    'kota' => $request->kota,
                ]);

            // Update name di tabel users juga
            DB::table('users')
                ->where('id_user', auth()->user()->id_user)
                ->update([
                    'name' => $request->nama,
                    'updated_at' => now(),
                ]);

            DB::commit();

            return redirect()->route('profile.show')
                ->with('success', 'Profile berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Gagal memperbarui profile: ' . $e->getMessage());
        }
    }

    public function riwayat()
    {
        $loans = Peminjaman::with('ebook.kategori')
            ->where('id_anggota', Auth::id())
            ->orderByDesc('tanggal_pinjam')
            ->get();

        return view('anggota.riwayat_saya', compact('loans'));
    }
}
