<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AppSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PengaturanController extends Controller
{
    public function index()
    {
        $appSettings = [
            'nama_aplikasi' => AppSetting::get('nama_aplikasi', 'Libco'),
            'deskripsi'     => AppSetting::get('deskripsi', ''),
            'email_kontak'  => AppSetting::get('email_kontak', ''),
            'telp_kontak'   => AppSetting::get('telp_kontak', ''),
            'alamat'        => AppSetting::get('alamat', ''),
            'maks_pinjam'   => AppSetting::get('maks_pinjam', 3),
            'durasi_pinjam' => AppSetting::get('durasi_pinjam', 7),
            'tema' => AppSetting::get('tema', 'libco'), // ubah default dari 'indigo' ke 'libco'
            'sidebar_style' => AppSetting::get('sidebar_style', 'solid'),
        ];

      return view('admin.pengaturan.index', compact('appSettings'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password_lama'             => 'required',
            'password_baru'             => 'required|min:8|confirmed',
        ]);

        if (!Hash::check($request->password_lama, Auth::user()->password)) {
            return back()->withErrors(['password_lama' => 'Password lama salah'])
                         ->with('tab', 'password');
        }

        Auth::user()->update(['password' => Hash::make($request->password_baru)]);

        return back()->with('success_password', 'Password berhasil diubah')
                     ->with('tab', 'password');
    }

    public function updateAplikasi(Request $request)
    {
        $request->validate([
            'nama_aplikasi' => 'required|string|max:100',
            'email_kontak'  => 'nullable|email',
            'maks_pinjam'   => 'required|integer|min:1|max:30',
            'durasi_pinjam' => 'required|integer|min:1|max:90',
        ]);

        foreach (['nama_aplikasi','deskripsi','email_kontak','telp_kontak','alamat','maks_pinjam','durasi_pinjam'] as $key) {
            AppSetting::set($key, $request->input($key));
        }

        return back()->with('success_aplikasi', 'Pengaturan berhasil disimpan')
                     ->with('tab', 'aplikasi');
    }

    public function updateTema(Request $request)
    {
        AppSetting::set('tema',          $request->input('tema', 'indigo'));
        AppSetting::set('sidebar_style', $request->input('sidebar_style', 'solid'));

        return back()->with('success_tema', 'Tema berhasil diterapkan')
                     ->with('tab', 'tema');
    }
}