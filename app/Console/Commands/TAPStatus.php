<?php

namespace App\Console\Commands;

use App\Models\Absensi;
use App\Models\Waktu_Absen;
use Carbon\Carbon;
use Illuminate\Console\Command;

class TAPStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tapstatus:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'TAP status updated';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();
        $waktuAbsen = Waktu_Absen::first();
        
        // Get all records that need updating
        $records = Absensi::where('status', 'Hadir')
            ->whereNull('jam_pulang')
            ->whereNull('photo_out')
            ->get();

        foreach ($records as $record) {
            if ($now->format('H:i:s') > $waktuAbsen->batas_absen_pulang) {
                // Calculate minutes from 12 PM to batas_absen_pulang
                $start = Carbon::createFromFormat('H:i:s', '12:00:00');
                $end = Carbon::createFromFormat('H:i:s', $waktuAbsen->batas_absen_pulang);
                
                $minutesDiff = $start->diffInMinutes($end);
                
                $record->update([
                    'menit_tap' => $minutesDiff
                ]);
            }
        }

        $this->info('TAP status updated successfully');
    }
}
