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
            'nama' => 'Reyga Marza Ramadhan',
            'jenis_kelamin' => 'laki laki',
            'nik' => '3210123456789012',
            'nisn' => '0045678901',
        ]);

        siswa::create([
            'nis' => '0062894371',
            'id_user' => 3,
            'id_kelas' => 2,
            'nama' => 'Satria Galam Pratama',
            'jenis_kelamin' => 'laki laki',
            'nik' => '3210987654321098',
            'nisn' => '0045678902',
        ]);

        siswa::create([
            'nis' => '0069584720',
            'id_user' => 4,
            'id_kelas' => 3,
            'nama' => 'Irma Naila Juwita',
            'jenis_kelamin' => 'perempuan',
            'nik' => '3210876543210987',
            'nisn' => '0045678903',
        ]);
    }
}
