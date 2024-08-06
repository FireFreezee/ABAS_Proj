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
        wali_siswa::create([
            'nik' => '2108410',
            'id_user' => 'WS001',
            'jenis_kelamin' => 'laki laki',
        ]);

        wali_siswa::create([
            'nik' => '2108411',
            'id_user' => 'WS002',
            'jenis_kelamin' => 'laki laki',
        ]);

        wali_siswa::create([
            'nik' => '2108412',
            'id_user' => 'WS003',
            'jenis_kelamin' => 'laki laki',
        ]);
    }
}
