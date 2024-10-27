<?php

namespace Database\Seeders;

use App\Models\Absensi;
use App\Models\Siswa;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AbsensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $siswa = Siswa::all();
        $photo = "default.png";

        $dateRange = new CarbonPeriod('2024-07-03', '1 days', Carbon::yesterday()->format('Y-m-d'));

        $titikKoordinat = '-6.890622076541303, 107.55806983605572';
        foreach ($siswa as $s) {
            foreach ($dateRange as $date) {
                if (Carbon::createFromDate($date)->isWeekday())
                {

                    $random = rand(0, 14);
                    $status = [
                        "hadir",
                        "terlambat",
                        "hadir",
                        "sakit",
                        "hadir",
                        "izin",
                        "hadir",
                        "alfa",
                        "hadir",
                        "terlambat",
                        "hadir",
                        "TAP",
                        "hadir",
                        "terlambat",
                        "hadir",
                    ];
                    if ($status[$random] == "sakit" || $status[$random] == "izin" || $status[$random] == "TAP") {
                        absensi::create([
                            'nis' =>  "$s->nis",
                            'status' => $status[$random],
                            'photo_in' => $photo,
                            'photo_out' => $photo,
                            'date' => $date,
                            'jam_masuk' => '06:20:00',
                            'titik_koordinat_masuk' => $titikKoordinat,
                            'titik_koordinat_pulang' => $titikKoordinat,
                        ]);
                    } elseif ($status[$random] == "hadir" || $status[$random] == "terlambat") {
                        absensi::create([
                            'nis' =>  "$s->nis",
                            'status' => $status[$random],
                            'photo_in' => $photo,
                            'photo_out' => $photo,
                            'date' => $date,
                            'jam_masuk' => '06:20:00',
                            'jam_pulang' => '17:00:00',
                            'titik_koordinat_masuk' => $titikKoordinat,
                            'titik_koordinat_pulang' => $titikKoordinat,
                        ]);
                    } else {
                        absensi::create([
                            'nis' =>  "$s->nis",
                            'status' => $status[$random],
                            'photo_in' => $photo,
                            'photo_out' => $photo,
                            'date' => $date,
                            'titik_koordinat_masuk' => $titikKoordinat,
                            'titik_koordinat_pulang' => $titikKoordinat,
                        ]);
                    }
                }
            }
        }
    }
}