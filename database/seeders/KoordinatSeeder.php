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
            'lokasi_sekolah' => '-6.89033536888645, 107.55833009635417',
            'radius' => 200.00
        ]);
    }
}
