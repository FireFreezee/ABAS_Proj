<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\koordinat_sekolah;

class KoordinatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        koordinat_sekolah::create([
            'id_koordinat_sekolah' => '1',
            'lokasi_sekolah' => '-6.9131982, 107.6090273',
            'radius' => 200.00
        ]);
    }
}
