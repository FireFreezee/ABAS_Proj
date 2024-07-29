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
                $kelas = Kelas::create([
                    'nomor_kelas' => $row['nomor_kelas'],
                    'id_jurusan' => $jurusanId,
                    'tingkat' => $row['tingkat'],
                ]);

                $user = User::create([
                    'name' => $row['nama'],
                    'email' => $row['email'],
                    'password' => password_hash("12345678", PASSWORD_DEFAULT),
                    'role' => 'siswa'
                ]);

                Siswa::insert([
                    'nis' => $row['nis'],
                    'id' => $user->id,
                    'id_kelas' => $kelas->id_kelas,
                    'jenis_kelamin' => $row['jenis_kelamin'],
                    'nisn' => $row['nisn'],
                ]);
            } else {

            }
        }
    }
}
