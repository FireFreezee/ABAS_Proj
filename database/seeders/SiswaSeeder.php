<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Siswa;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        siswa::create([
            'nis' => '0061748352',
            'id_user' => 2,
            'id_kelas' => 1,
            'nik' => '2108410',
            'jenis_kelamin' => 'laki laki',
            'nisn' => '0045678901',
        ]);

        siswa::create([
            'nis' => '0062894371',
            'id_user' => 3,
            'id_kelas' => 2,
            'nik' => '2108411',
            'jenis_kelamin' => 'laki laki',
            'nisn' => '0045678902',
        ]);

        siswa::create([
            'nis' => '0069584720',
            'id_user' => 4,
            'id_kelas' => 3,
            'nik' => '2108412',
            'jenis_kelamin' => 'perempuan',
            'nisn' => '0045678903',
        ]);
    }
}
