<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Siswa;
use App\Models\Wali_Siswa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
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

    public function detailLaporan(Request $request)
    {
        $startDate = $request->input('start');
        $endDate = $request->input('end');

        // Set default to the current month if no dates are provided
        if (!$startDate || !$endDate) {
            $startDate = Carbon::now()->startOfMonth()->toDateString();
            $endDate = Carbon::now()->endOfMonth()->toDateString();
        }

        // Get the guardian's information
        $waliSiswa = Wali_Siswa::where('id_user', auth()->id())->first();

        // Get all students related to the guardian with eager loading
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

        // Initialize counters for each status
        $statusCounts = [
            'Hadir' => 0,
            'Sakit/Izin' => 0,
            'Alfa' => 0,
            'Terlambat' => 0,
            'TAP' => 0,
        ];

        // Get business days count for the date range
        $businessDaysCount = $this->getBusinessDaysCount($startDate, $endDate);

        // Array to hold paginated attendance records for each student
        $studentAttendanceData = [];

        foreach ($siswas as $siswa) {
            $nis = $siswa->nis;

            // Calculate lateness for the specified date range
            $late = Absensi::where('nis', $nis)
                ->whereBetween('date', [$startDate, $endDate])
                ->sum('menit_keterlambatan');
            $siswa->setAttribute('late', $late);

            // Fetch attendance data for the selected date range with pagination
            $absensiRecords = Absensi::where('nis', $nis)
                ->whereBetween('date', [$startDate, $endDate]);

            // Get current page and items per page
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $perPage = 10;

            // Paginate the records
            $paginatedRecords = new LengthAwarePaginator(
                $absensiRecords->clone()->forPage($currentPage, $perPage)->get(),
                $absensiRecords->count(),
                $perPage,
                $currentPage,
                ['path' => LengthAwarePaginator::resolveCurrentPath()]
            );

            // Store paginated records for this student
            $studentAttendanceData[$nis] = $paginatedRecords;

            // Calculate attendance summary for the student
            $absensiSummary = $absensiRecords->select('status', DB::raw('count(*) as total'))
                ->groupBy('status')
                ->pluck('total', 'status')
                ->toArray();

            // Combine 'Sakit' and 'Izin' into 'Sakit/Izin'
            $absensiSummary['Sakit/Izin'] = ($absensiSummary['Sakit'] ?? 0) + ($absensiSummary['Izin'] ?? 0);
            unset($absensiSummary['Sakit'], $absensiSummary['Izin']);

            // Statuses to calculate
            $statuses = ['Hadir', 'Sakit/Izin', 'Alfa', 'Terlambat', 'TAP'];

            // Initialize missing statuses to 0 and store the counts for each student
            foreach ($statuses as $status) {
                $absensiSummary[$status] = $absensiSummary[$status] ?? 0;

                // Update the status counts globally
                $statusCounts[$status] += $absensiSummary[$status];

                // Set each student's status count
                $siswa->setAttribute($status, $absensiSummary[$status]);
            }

            // Set attributes for the date range based on business days
            $siswa->setAttribute('persentaseHadir', $businessDaysCount > 0 ? round(($absensiSummary['Hadir'] / $businessDaysCount) * 100) : 0);
            $siswa->setAttribute('persentaseSakitIzin', $businessDaysCount > 0 ? round(($absensiSummary['Sakit/Izin'] / $businessDaysCount) * 100) : 0);
            $siswa->setAttribute('persentaseAlfa', $businessDaysCount > 0 ? round(($absensiSummary['Alfa'] / $businessDaysCount) * 100) : 0);
            $siswa->setAttribute('persentaseTerlambat', $businessDaysCount > 0 ? round(($absensiSummary['Terlambat'] / $businessDaysCount) * 100) : 0);
            $siswa->setAttribute('persentaseTAP', $businessDaysCount > 0 ? round(($absensiSummary['TAP'] / $businessDaysCount) * 100) : 0);
        }

        // Pass all relevant data to the view
        return view('walisiswa.detailLaporan', [
            'siswas' => $siswas,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'studentAttendanceData' => $studentAttendanceData, // Pass paginated attendance records
        ]);
    }

    private function getBusinessDaysCount($startDate, $endDate)
    {
        // Create a collection of dates between start and end dates
        $start = Carbon::parse($startDate);
        $end = Carbon::parse($endDate);
        $businessDaysCount = 0;

        // Iterate through each date and check if it's a business day
        while ($start->lte($end)) {
            // Check if the day is a weekday (Monday to Friday)
            if ($start->isWeekday()) {
                $businessDaysCount++;
            }
            $start->addDay();
        }

        return $businessDaysCount;
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
