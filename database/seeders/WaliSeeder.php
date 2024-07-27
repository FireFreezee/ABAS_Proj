<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Wali_Kelas;

class WaliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        wali_kelas::create([
            'nuptk' => '1234567890123456',
            'id' => 5,
            'nama' => 'Engkus Kusnadi',
            'jenis_kelamin' => 'laki laki',
            'nip' => '198005052022011001',
        ]);

        wali_kelas::create([
            'nuptk' => '2345678901234567',
            'id' => 6,
            'nama' => 'Himatul Munawaroh',
            'jenis_kelamin' => 'perempuan',
            'nip' => '198107062022021002',
        ]);

        wali_kelas::create([
            'nuptk' => '3456789012345678',
            'id' => 7,
            'nama' => 'Ani Nuraeni',
            'jenis_kelamin' => 'perempuan',
            'nip' => '198209072022031003',
        ]);
    }
}
