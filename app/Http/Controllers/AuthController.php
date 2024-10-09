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
    public function index()
    {
        return view('login.login');
    }

    public function postlogin(Request $request)
    {
        $request->validate([
            'identifier' => 'required',
            'password' => 'required',
        ]);

        // Mencari pengguna di tabel User berdasarkan NIS
        if ($siswa = Siswa::where('nis', $request->identifier)->first()) {
            $user = User::find($siswa->id_user); // Pastikan ada relasi antara Siswa dan User
            if ($user && Hash::check($request->password, $user->password)) {
                Auth::login($user);
                return redirect()->route('check');
            }
        }
        // Mencari pengguna di tabel User berdasarkan NIK
        elseif ($waliSiswa = Wali_Siswa::where('nik', $request->identifier)->first()) {
            $user = User::find($waliSiswa->id_user); // Pastikan ada relasi antara walisiswa dan User
            if ($user && Hash::check($request->password, $user->password)) {
                Auth::login($user);
                return redirect()->route('check');
            }
        }
        // Mencari pengguna di tabel User berdasarkan NUPTK
        elseif ($waliKelas = Wali_Kelas::where('nuptk', $request->identifier)->first()) {
            $user = User::find($waliKelas->id_user); // Pastikan ada relasi antara walikelas dan User
            if ($user && Hash::check($request->password, $user->password)) {
                Auth::login($user);
                return redirect()->route('check');
            }
        }
        // Mencari pengguna di tabel User berdasarkan Email
        elseif ($user = User::where('email', $request->identifier)->first()) {
            if ($user && Hash::check($request->password, $user->password)) {
                Auth::login($user);
                return redirect()->route('check');
            }
        }

        return back()->withErrors([
            'identifier' => 'Data login tidak valid.',
        ]);
    }

}
