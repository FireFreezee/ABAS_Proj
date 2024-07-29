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

            $jurusan = Jurusan::where('nama_jurusan', $row['nama_jurusan'])->first();
            $jurusanId = $jurusan ? $jurusan->id_jurusan : null;

            // Check if both foreign keys are valid
            if ($jurusanId) {
                // Check if the Kelas already exists
                $kelas = Kelas::where('nomor_kelas', $row['nomor_kelas'])
                              ->where('id_jurusan', $jurusanId)
                              ->first();

                if ($kelas) {
                    // Update existing Kelas
                    $kelas->update([
                        'tingkat' => $row['tingkat'],
                    ]);
                } else {
                    // Create new Kelas
                    $kelas = Kelas::create([
                        'nomor_kelas' => $row['nomor_kelas'],
                        'id_jurusan' => $jurusanId,
                        'tingkat' => $row['tingkat'],
                    ]);
                }

                // Check if the User already exists
                $user = User::where('email', $row['email'])->first();
                if ($user) {
                    // Update existing User
                    $user->update([
                        'name' => $row['nama'],
                        'password' => password_hash("12345678", PASSWORD_DEFAULT), // Optional: only update password if needed
                    ]);
                } else {
                    // Create new User
                    $user = User::create([
                        'name' => $row['nama'],
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
                        'id' => $user->id,
                        'id_kelas' => $kelas->id_kelas,
                        'jenis_kelamin' => $row['jenis_kelamin'],
                        'nisn' => $row['nisn'],
                    ]);
                } else {
                    // Create new Siswa
                    Siswa::create([
                        'nis' => $row['nis'],
                        'id' => $user->id,
                        'id_kelas' => $kelas->id_kelas,
                        'jenis_kelamin' => $row['jenis_kelamin'],
                        'nisn' => $row['nisn'],
                    ]);
                }
            } else {
                // Handle cases where Jurusan does not exist
            }
        }
    }
}
