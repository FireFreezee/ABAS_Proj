<?php

namespace App\Console\Commands;

use App\Models\Absensi;
use App\Models\Siswa;
use Carbon\Carbon;
use Illuminate\Console\Command;

class AutoInsertAbsensiData extends Command
{
    protected $signature = 'absensi:insert';
    protected $description = 'Automatically insert data into absensi table on weekdays';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $today = Carbon::now();

        // Jika Weekend Absen tidak akan dimasukan
        // if ($today->isWeekend()) {
        //     $this->info("Today is a weekend. No absensi data inserted.");
        //     return;
        // }

        $date = $today->format('Y-m-d');

        // Fetch all students and create default absensi entries if not already present
        $students = Siswa::all();

        foreach ($students as $student) {
            Absensi::firstOrCreate(
                [
                    'nis' => $student->nis,
                    'date' => $date,
                ],
                [
                    'status' => 'Alfa', // Default status
                    'jam_masuk' => null,
                    'jam_pulang' => null,
                    'titik_koordinat_masuk' => null,
                    'titik_koordinat_pulang' => null,
                    'photo_in' => null,
                    'photo_out' => null,
                    'keterangan' => null,
                    'menit_keterlambatan' => null,
                ]
            );
        }

        $this->info("Daily absensi data inserted successfully for $date.");
    }
}
