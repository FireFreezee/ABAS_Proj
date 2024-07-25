<?php

namespace Database\Seeders;

use App\Models\absensi;
use App\Models\koordinat_sekolah;
use App\Models\waktu_absen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\select;

class otherTables extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('koordinat_sekolahs')->insert
        (
            [
                'titik_koordinat' => DB::raw('ST_GeomFromText("POINT(-6.9131982 107.6090273)", 4326)'),
                'id_koordinat_sekolah' => '1',
                'jarak' => 200.00
            ]
        );

        $waktu =
        [
            'id_waktu_absen' => 1,
            'jam_masuk' => '07:00:00',
            'mulai_absen' => '06:00:00',
            'jam_pulang' => '12:30:00'
        ];

        $absen =
        [
            [
                'id_absensi' => 1,
                'nis' => 110,
                'id_koordinat_sekolah' => 1,
                'id_waktu_absen' => 1,
                'status' => 'hadir',
                'bukti' => 'path',
                'keterangan' => null,
                'date' => now(),
                'jam_masuk' => '06:30:00',
                'jam_pulang' => '14:00:00',
                'titik_koordinat_masuk' =>  DB::raw('ST_GeomFromText("POINT(-6.9131982 107.6090273)", 4326)'),
                'titik_koordinat_pulang' =>  DB::raw('ST_GeomFromText("POINT(-6.9131982 107.6090273)", 4326)')
            ],

            [
                'id_absensi' => 2,
                'nis' => 111,
                'id_koordinat_sekolah' => 1,
                'id_waktu_absen' => 1,
                'status' => 'hadir',
                'bukti' => 'path',
                'keterangan' => null,
                'date' => now(),
                'jam_masuk' => '06:30:00',
                'jam_pulang' => null,
                'titik_koordinat_masuk' =>  DB::raw('ST_GeomFromText("POINT(-6.9131982 107.6090273)", 4326)'),
                'titik_koordinat_pulang' =>  null
            ]
        ];

        waktu_absen::insert($waktu);
        absensi::insert($absen);
    }
}