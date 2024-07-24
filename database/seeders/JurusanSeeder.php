<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Jurusan;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data_jurusan = [
            ['nama_jurusan' => 'AK'],
            ['nama_jurusan' => 'AKL'],
            ['nama_jurusan' => 'BR'],
            ['nama_jurusan' => 'DKV'],
            ['nama_jurusan' => 'MLOG'],
            ['nama_jurusan' => 'MPLB'],
            ['nama_jurusan' => 'MP'],
            ['nama_jurusan' => 'PM'],
            ['nama_jurusan' => 'PPLG'],
            ['nama_jurusan' => 'RPL'],
            ['nama_jurusan' => 'TJKT'],
            ['nama_jurusan' => 'TKJ'],
        ];

        foreach ($data_jurusan as $j) {
            jurusan::create($j);
        }
    }
}
