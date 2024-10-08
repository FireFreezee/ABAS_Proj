<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\User;
use App\Models\Wali_Kelas;
use App\Models\Wali_Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'identifier' => 'required',
            'password' => 'required',
        ]);

        // Mencari pengguna di tabel User berdasarkan NIS
        $siswa = Siswa::where('nis', $request->identifier)->first();
        if ($siswa) {
            $user = User::find($siswa->id_user); // Pastikan ada relasi antara Siswa dan User
            if ($user && Hash::check($request->password, $user->password)) {
                Auth::login($user);
                return redirect()->intended($this->redirectTo('siswa'));
            }
        }

        // Mencari pengguna di tabel User berdasarkan NIK
        $waliSiswa = Wali_Siswa::where('nik', $request->identifier)->first();
        if ($waliSiswa) {
            $user = User::find($waliSiswa->id_user); // Pastikan ada relasi antara Wali Siswa dan User
            if ($user && Hash::check($request->password, $user->password)) {
                Auth::login($user);
                return redirect()->intended($this->redirectTo('walis'));
            }
        }

        // Mencari pengguna di tabel User berdasarkan NUPTK
        $waliKelas = Wali_Kelas::where('nuptk', $request->identifier)->first();
        if ($waliKelas) {
            $user = User::find($waliKelas->id_user); // Pastikan ada relasi antara Wali Kelas dan User
            if ($user && Hash::check($request->password, $user->password)) {
                Auth::login($user);
                return redirect()->intended($this->redirectTo('wali'));
            }
        }

        // Mencari pengguna di tabel User untuk kesiswaan dan operator berdasarkan email
        $user = User::where('email', $request->identifier)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            return redirect()->intended($this->redirectTo($user->role));
        }

        return back()->withErrors([
            'identifier' => 'Data login tidak valid.',
        ]);
    }

    // Fungsi untuk mengarahkan berdasarkan role
    protected function redirectTo($role)
    {
        switch ($role) {
            case 'kesiswaan':
                return 'kesiswaan';
            case 'siswa':
                return 'siswa';
            case 'wali':
                return 'wali';
            case 'operator':
                return 'operator';
            case 'walis':
                return 'walis';
            default:
                return '/';
        }
    }
}
