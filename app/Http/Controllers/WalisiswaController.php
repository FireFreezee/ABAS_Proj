<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Siswa;
use App\Models\Wali_Siswa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WalisiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $waliSiswa = Wali_Siswa::where('id_user', Auth::id())->first();
        $hariini = date("Y-m-d");

        $siswas = Siswa::with('user', 'kelas', 'ayah', 'ibu', 'wali')
            ->where(function ($query) use ($waliSiswa) {
                if ($waliSiswa->jenis_kelamin == "laki laki") {
                    $query->where('nik_ayah', $waliSiswa->nik)
                        ->orWhere('nik_wali', $waliSiswa->nik);
                } elseif ($waliSiswa->jenis_kelamin == "perempuan") {
                    $query->where('nik_ibu', $waliSiswa->nik)
                        ->orWhere('nik_wali', $waliSiswa->nik);
                }
            })->get();

        function getBusinessDays($year, $month)
        {
            $startOfMonth = Carbon::create($year, $month, 1);
            $endOfMonth = $startOfMonth->copy()->endOfMonth();

            $businessDays = 0;

            // Loop through the days of the month
            for ($day = $startOfMonth; $day <= $endOfMonth; $day->addDay()) {
                if ($day->isWeekday()) { // Only count weekdays
                    $businessDays++;
                }
            }

            return $businessDays;
        }

        foreach ($siswas as $siswa) {
            $nis = $siswa->nis;

            // Fetch attendance for today for this specific student
            $cek = DB::table('absensis')->where('date', $hariini)->where('nis', $nis)->first();
    
            // Calculate lateness for current and previous months
            $late2 = Absensi::where('nis', $nis)
                ->whereMonth('date', date('m', strtotime('first day of previous month')))
                ->sum('menit_keterlambatan');
            $late = Absensi::where('nis', $nis)
                ->whereMonth('date', date('m'))
                ->sum('menit_keterlambatan');
    
            // Determine attendance status for today
            $statusAbsen = 'Belum Absen';
            if ($cek) {
                if ($cek->jam_masuk) {
                    $statusAbsen = $cek->status;
                    if ($cek->photo_out || $cek->titik_koordinat_pulang) {
                        $statusAbsen = 'Sudah Pulang';
                    }
                }
            }
            $siswa->setAttribute('statusAbsen', $statusAbsen);
            $siswa->setAttribute('late', $late);
            $siswa->setAttribute('late2', $late2);

            // Get the number of business days for the current and previous months
            $businessDaysCurrentMonth = getBusinessDays(date('Y'), date('m'));
            $businessDaysPreviousMonth = getBusinessDays(date('Y'), date('m', strtotime('first day of previous month')));

            // Fetch attendance data for current month
            $dataBulanIni = Absensi::whereYear('date', date('Y'))
                ->where('nis', $nis)
                ->whereMonth('date', date('m'))
                ->select('status', DB::raw('count(*) as total'))
                ->groupBy('status')
                ->pluck('total', 'status')
                ->toArray();

            // Fetch attendance data for the previous month
            $dataBulanSebelumnya = Absensi::whereYear('date', date('Y'))
                ->where('nis', $nis)
                ->whereMonth('date', date('m', strtotime('first day of previous month')))
                ->select('status', DB::raw('count(*) as total'))
                ->groupBy('status')
                ->pluck('total', 'status')
                ->toArray();

            // Combine 'Sakit' and 'Izin' into 'Sakit/Izin' for both months
            $dataBulanIni['Sakit/Izin'] = ($dataBulanIni['Sakit'] ?? 0) + ($dataBulanIni['Izin'] ?? 0);
            unset($dataBulanIni['Sakit'], $dataBulanIni['Izin']);

            $dataBulanSebelumnya['Sakit/Izin'] = ($dataBulanSebelumnya['Sakit'] ?? 0) + ($dataBulanSebelumnya['Izin'] ?? 0);
            unset($dataBulanSebelumnya['Sakit'], $dataBulanSebelumnya['Izin']);

            // Statuses to calculate
            $statuses = ['Hadir', 'Sakit/Izin', 'Alfa', 'Terlambat', 'TAP'];

            // Initialize missing statuses to 0
            foreach ($statuses as $status) {
                $dataBulanIni[$status] = $dataBulanIni[$status] ?? 0;
                $dataBulanSebelumnya[$status] = $dataBulanSebelumnya[$status] ?? 0;
            }

            // Set attributes for current month based on business days
            $siswa->setAttribute('persentaseHadirBulanIni', $businessDaysCurrentMonth > 0 ? round(($dataBulanIni['Hadir'] / $businessDaysCurrentMonth) * 100) : 0);
            $siswa->setAttribute('persentaseSakitIzinBulanIni', $businessDaysCurrentMonth > 0 ? round(($dataBulanIni['Sakit/Izin'] / $businessDaysCurrentMonth) * 100) : 0);
            $siswa->setAttribute('persentaseAlfaBulanIni', $businessDaysCurrentMonth > 0 ? round(($dataBulanIni['Alfa'] / $businessDaysCurrentMonth) * 100) : 0);
            $siswa->setAttribute('persentaseTerlambatBulanIni', $businessDaysCurrentMonth > 0 ? round(($dataBulanIni['Terlambat'] / $businessDaysCurrentMonth) * 100) : 0);
            $siswa->setAttribute('persentaseTAPBulanIni', $businessDaysCurrentMonth > 0 ? round(($dataBulanIni['TAP'] / $businessDaysCurrentMonth) * 100) : 0);

            // Set attributes for previous month based on business days
            $siswa->setAttribute('persentaseHadirBulanSebelumnya', $businessDaysPreviousMonth > 0 ? round(($dataBulanSebelumnya['Hadir'] / $businessDaysPreviousMonth) * 100) : 0);
            $siswa->setAttribute('persentaseSakitIzinBulanSebelumnya', $businessDaysPreviousMonth > 0 ? round(($dataBulanSebelumnya['Sakit/Izin'] / $businessDaysPreviousMonth) * 100) : 0);
            $siswa->setAttribute('persentaseAlfaBulanSebelumnya', $businessDaysPreviousMonth > 0 ? round(($dataBulanSebelumnya['Alfa'] / $businessDaysPreviousMonth) * 100) : 0);
            $siswa->setAttribute('persentaseTerlambatBulanSebelumnya', $businessDaysPreviousMonth > 0 ? round(($dataBulanSebelumnya['Terlambat'] / $businessDaysPreviousMonth) * 100) : 0);
            $siswa->setAttribute('persentaseTAPBulanSebelumnya', $businessDaysPreviousMonth > 0 ? round(($dataBulanSebelumnya['TAP'] / $businessDaysPreviousMonth) * 100) : 0);

            // Set attendance data
            $siswa->setAttribute('dataBulanIni', $dataBulanIni);
            $siswa->setAttribute('dataBulanSebelumnya', $dataBulanSebelumnya);
        }

        return view('walisiswa.walisiswa', compact('siswas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
