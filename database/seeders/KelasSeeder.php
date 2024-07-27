<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kelas;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        kelas::create([
            'id_jurusan' => 9,
            'nomor_kelas' => 2,
            'tingkat' => '10',
            'jumlah_siswa' => 36,
        ]);

        kelas::create([
            'id_jurusan' => 10,
            'nomor_kelas' => 1,
            'tingkat' => '11',
            'jumlah_siswa' => 35,
        ]);

        kelas::create([
            'id_jurusan' => 10,
            'nomor_kelas' => 1,
            'tingkat' => '12',
            'jumlah_siswa' => 35,
        ]);
    }
}
