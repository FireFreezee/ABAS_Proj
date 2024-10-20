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
            'id_user' => 9
        ]);

        wali_siswa::insert([
            'nik' => '2345678901234567',
            'id_user' => 10,
            'jenis_kelamin' => 'perempuan'
        ]);

        wali_siswa::insert([
            'nik' => '3456789012345678',
            'id_user' => 11
        ]);
    }
}
