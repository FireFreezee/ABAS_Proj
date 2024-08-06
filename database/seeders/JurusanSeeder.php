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
            ['id_jurusan' => 'AK','nama_jurusan' => 'Akutansi'],
            ['id_jurusan' => 'AKL','nama_jurusan' => 'Akutansi dan Keuangan Lembaga'],
            ['id_jurusan' => 'BR','nama_jurusan' => 'Bisnis Ritel'],
            ['id_jurusan' => 'DKV','nama_jurusan' => 'Desain Komunikasi Visual'],
            ['id_jurusan' => 'MLOG','nama_jurusan' => 'Manajemen Logistik'],
            ['id_jurusan' => 'MPLB','nama_jurusan' => 'Manajemen Perkantoran dan Layanan Bisnis'],
            ['id_jurusan' => 'MP','nama_jurusan' => 'Manajemen Perkantoran'],
            ['id_jurusan' => 'PM','nama_jurusan' => 'Pemasaran'],
            ['id_jurusan' => 'PPLG','nama_jurusan' => 'Pengembangan Perangkat Lunak dan Game'],
            ['id_jurusan' => 'RPL','nama_jurusan' => 'Rekayasa Perangkat Lunak'],
            ['id_jurusan' => 'TJKT','nama_jurusan' => 'Teknik Jaringan Komputer dan Telekomunikasi'],
            ['id_jurusan' => 'TKJ','nama_jurusan' => 'Teknik Komputer Jaringan'],
        ];

        foreach ($data_jurusan as $j) {
            jurusan::create($j);
        }
    }
}
