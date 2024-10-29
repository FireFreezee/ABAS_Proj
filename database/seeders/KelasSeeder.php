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
            'id_jurusan' => 'PPLG',
            'nomor_kelas' => 2,
            'nip' => '198005052022011001',
            'tingkat' => '10',
        ]);

        kelas::create([
            'id_jurusan' => 'RPL',
            'nomor_kelas' => 1,
            'nip' => '198107062022021002',
            'tingkat' => '11',
        ]);

        kelas::create([
            'id_jurusan' => 'RPL',
            'nomor_kelas' => 1,
            'nip' => '198209072022031003',
            'tingkat' => '12',
        ]);
    }
}
