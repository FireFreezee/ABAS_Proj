<?php

namespace Database\Seeders;

use App\Models\Waktu_Absen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WaktuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Waktu_Absen::create([
            'id_waktu_absen' => 1,
            'jam_absen' => '06:00:00',
            'batas_absen_masuk' => '07:00:00',
            'jam_pulang' => '15:00:00',
            'batas_absen_pulang' => '17:00:00'
        ]);
    }
}
