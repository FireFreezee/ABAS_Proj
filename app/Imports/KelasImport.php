<?php

namespace App\Imports;


use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
use App\Models\Wali_Kelas;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class KelasImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // Check if the User already exists
            $user = User::where('email', $row['email'])->first();
            if ($user) {
                // Update existing User
                $user->update([
                    'nama' => $row['nama'],
                    'password' => password_hash("12345678", PASSWORD_DEFAULT), // Optional: only update password if needed
                ]);
            } else {
                // Create new User
                $user = User::create([
                    'nama' => $row['nama'],
                    'email' => $row['email'],
                    'password' => password_hash("12345678", PASSWORD_DEFAULT),
                    'role' => 'siswa'
                ]);
            }

            // Check if the Siswa already exists
            $siswa = Siswa::where('nis', $row['nis'])->first();
            if ($siswa) {
                // Update existing Siswa
                $siswa->update([
                    'id_user' => $user->id,
                    'id_kelas' => $kelas->id_kelas,
                    'jenis_kelamin' => $row['jenis_kelamin'],
                    'nisn' => $row['nisn'],
                ]);
            } else {
                // Create new Siswa
                Siswa::create([
                    'nis' => $row['nis'],
                    'id_user' => $user->id,
                    'id_kelas' => $kelas->id_kelas,
                    'jenis_kelamin' => $row['jenis_kelamin'],
                    'nisn' => $row['nisn'],
                ]);
            }
            // User and Siswa creation/update logic remains the same...
        }    
    }
}

