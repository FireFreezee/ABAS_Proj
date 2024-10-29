<?php

namespace Database\Seeders;

use App\Models\wali_siswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WaliSiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        wali_siswa::insert([
            'nik' => '1234567890123456',
            'id_user' => 9,
            'jenis_kelamin' => 'laki laki',
            'alamat' => 'jalan jalan',
        ]);

        wali_siswa::insert([
            'nik' => '2345678901234567',
            'id_user' => 10,
            'jenis_kelamin' => 'perempuan',
            'alamat' => 'jalan jalan',
        ]);

        wali_siswa::insert([
            'nik' => '3456789012345678',
            'id_user' => 11,
            'jenis_kelamin' => 'laki laki',
            'alamat' => 'jalan jalan',
        ]);
    }
}
