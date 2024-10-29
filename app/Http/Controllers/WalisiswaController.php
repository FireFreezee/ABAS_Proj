<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Siswa;
use App\Models\User;
use App\Models\Wali_Siswa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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

        function getEffectiveBusinessDays($year, $month, $nis)
        {
            $startOfMonth = Carbon::create($year, $month, 1);
            $endOfMonth = $startOfMonth->copy()->endOfMonth();

            $effectiveDays = [];

            // Loop through the days of the month
            for ($day = $startOfMonth; $day <= $endOfMonth; $day->addDay()) {
                if ($day->isWeekday()) { // Only count weekdays
                    // Check if there is attendance record for this day
                    $exists = DB::table('absensis')
                        ->where('nis', $nis)
                        ->where('date', $day->toDateString())
                        ->exists();
                    if ($exists) {
                        $effectiveDays[] = $day->toDateString();
                    }
                }
            }

            return count($effectiveDays);
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

            // Get the number of effective business days for the current and previous months
            $effectiveDaysCurrentMonth = getEffectiveBusinessDays(date('Y'), date('m'), $nis);
            $effectiveDaysPreviousMonth = getEffectiveBusinessDays(date('Y'), date('m', strtotime('first day of previous month')), $nis);

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

            // Combine 'Hadir', 'Terlambat', and 'TAP' into 'Hadir/Terlambat/TAP' for current month
            $dataBulanIni['Hadir/Terlambat/TAP'] = ($dataBulanIni['Hadir'] ?? 0) + ($dataBulanIni['Terlambat'] ?? 0) + ($dataBulanIni['TAP'] ?? 0);
            unset($dataBulanIni['Hadir'], $dataBulanIni['Terlambat'], $dataBulanIni['TAP']);

            // Combine for previous month
            $dataBulanSebelumnya['Hadir/Terlambat/TAP'] = ($dataBulanSebelumnya['Hadir'] ?? 0) + ($dataBulanSebelumnya['Terlambat'] ?? 0) + ($dataBulanSebelumnya['TAP'] ?? 0);
            unset($dataBulanSebelumnya['Hadir'], $dataBulanSebelumnya['Terlambat'], $dataBulanSebelumnya['TAP']);

            // Statuses to calculate
            $statuses = ['Hadir/Terlambat/TAP', 'Sakit/Izin', 'Alfa'];

            // Initialize missing statuses to 0
            foreach ($statuses as $status) {
                $dataBulanIni[$status] = $dataBulanIni[$status] ?? 0;
                $dataBulanSebelumnya[$status] = $dataBulanSebelumnya[$status] ?? 0;
            }

            // Set attributes for current month based on effective business days
            $siswa->setAttribute('persentaseHadirBulanIni', $effectiveDaysCurrentMonth > 0 ? round(($dataBulanIni['Hadir/Terlambat/TAP'] / $effectiveDaysCurrentMonth) * 100) : 0);
            $siswa->setAttribute('persentaseSakitIzinBulanIni', $effectiveDaysCurrentMonth > 0 ? round(($dataBulanIni['Sakit/Izin'] / $effectiveDaysCurrentMonth) * 100) : 0);
            $siswa->setAttribute('persentaseAlfaBulanIni', $effectiveDaysCurrentMonth > 0 ? round(($dataBulanIni['Alfa'] / $effectiveDaysCurrentMonth) * 100) : 0);

            // Set attributes for previous month based on effective business days
            $siswa->setAttribute('persentaseHadirBulanSebelumnya', $effectiveDaysPreviousMonth > 0 ? round(($dataBulanSebelumnya['Hadir/Terlambat/TAP'] / $effectiveDaysPreviousMonth) * 100) : 0);
            $siswa->setAttribute('persentaseSakitIzinBulanSebelumnya', $effectiveDaysPreviousMonth > 0 ? round(($dataBulanSebelumnya['Sakit/Izin'] / $effectiveDaysPreviousMonth) * 100) : 0);
            $siswa->setAttribute('persentaseAlfaBulanSebelumnya', $effectiveDaysPreviousMonth > 0 ? round(($dataBulanSebelumnya['Alfa'] / $effectiveDaysPreviousMonth) * 100) : 0);

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
            'Hadir/Terlambat/TAP' => 0, // Initialize combined status
        ];

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
            $sakitCount = ($absensiSummary['Sakit'] ?? 0) + ($absensiSummary['Izin'] ?? 0);
            $absensiSummary['Sakit/Izin'] = $sakitCount;
            unset($absensiSummary['Sakit'], $absensiSummary['Izin']);

            // Combine 'Hadir', 'Terlambat', and 'TAP' into 'Hadir/Terlambat/TAP'
            $hadirCount = ($absensiSummary['Hadir'] ?? 0);
            $terlambatCount = ($absensiSummary['Terlambat'] ?? 0);
            $tapCount = ($absensiSummary['TAP'] ?? 0);

            $absensiSummary['Hadir/Terlambat/TAP'] = $hadirCount + $terlambatCount + $tapCount;
            unset($absensiSummary['Hadir'], $absensiSummary['Terlambat'], $absensiSummary['TAP']);

            // Statuses to calculate
            $statuses = ['Hadir/Terlambat/TAP', 'Sakit/Izin', 'Alfa'];

            // Initialize missing statuses to 0 and store the counts for each student
            foreach ($statuses as $status) {
                $absensiSummary[$status] = $absensiSummary[$status] ?? 0;

                // Update the status counts globally
                $statusCounts[$status] += $absensiSummary[$status];

                // Set each student's status count
                $siswa->setAttribute($status, $absensiSummary[$status]);
            }

            // Ensure combined status count is also updated
            $statusCounts['Hadir/Terlambat/TAP'] += $absensiSummary['Hadir/Terlambat/TAP'];

            // Count total attendance records in the specified date range
            $totalAttendanceRecords = array_sum($absensiSummary);

            // Set attributes for the date range based on actual attendance records
            $siswa->setAttribute('persentaseHadir', $totalAttendanceRecords > 0 ?
                round(($absensiSummary['Hadir/Terlambat/TAP'] / $totalAttendanceRecords) * 100) : 0);
            $siswa->setAttribute('persentaseSakitIzin', $totalAttendanceRecords > 0 ?
                round(($absensiSummary['Sakit/Izin'] / $totalAttendanceRecords) * 100) : 0);
            $siswa->setAttribute('persentaseAlfa', $totalAttendanceRecords > 0 ?
                round(($absensiSummary['Alfa'] / $totalAttendanceRecords) * 100) : 0);
        }

        // Pass all relevant data to the view
        return view('walisiswa.detailLaporan', [
            'siswas' => $siswas,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'studentAttendanceData' => $studentAttendanceData, // Pass paginated attendance records
        ]);
    }






    public function profile()
    {
        return view("walisiswa.profile");
    }

    public function editprofil(Request $r)
    {
        $f = false;
        $p = false;
        $u = false;

        // password
        if (strlen($r->password) > 0) {
            if ($r->password !== $r->kPassword) {
                return redirect()->back()->with('failed', 'Password Berbeda');
            }

            $p = User::where('id', $r->id)->update([
                'password' => password_hash($r->password, PASSWORD_DEFAULT),
            ]);
        }

        // foto
        $fileName = '';
        if ($r->profile) {
            $f = User::where('id', $r->id)->update([
                'foto' => $r->profile,
            ]);
        }

        // email
        if ($r->email) {
            $u = User::where('id', $r->id)->update([
                'email' => $r->email,
            ]);
        }

        // Redirecting
        if ($u || $f || $p) {
            return redirect()->route('walsis-dashboard')->with('success', "Data Berhasil di Update");
        } else {
            // If update fails, delete uploaded photo if it exists
            if ($fileName && Storage::disk('public')->exists("uploads/profile/{$fileName}")) {
                Storage::disk('public')->delete("uploads/profile/{$fileName}");
            }
            return redirect()->back()->with('failed', "Data Gagal di Update");
        }
    }

    public function photo_profile(Request $request)
    {
        $request->validate([
            'profile' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('profile')) {
            $file = $request->file('profile');
            $fileName = uniqid(true) . '-' . $file->getClientOriginalName();
            $folderPath = "public/uploads/profile/";
            $file->storeAs($folderPath, $fileName);

            return $fileName;
        }

        return '';
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
