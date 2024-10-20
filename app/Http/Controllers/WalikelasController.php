<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Kelas;
use App\Models\Siswa;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WalikelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $currentDay = Carbon::now()->format("Y-m-d");

        // Get the authenticated user
        $user = Auth::user();
        $nuptk = $user->wali->nuptk;

        // Find the class associated with the user
        $class = Kelas::where("nuptk", $nuptk)->first();

        // Get the students in that class
        $students = Siswa::where("id_kelas", $class->id_kelas)->get();
        $nis = $students->pluck('nis');

        // Total number of students in the class
        $totalStudents = $students->count();

        // Get attendance data for the current day
        $totalAttendance = Absensi::whereIn('nis', $nis)
            ->where('date', $currentDay)
            ->get();

        $totalRecords = $totalAttendance->count();

        // Count attendance statuses
        $countHadir = $totalAttendance->where('status', 'Hadir')->count();
        $countSakitIzin = $totalAttendance->where('status', 'Sakit')->count() + $totalAttendance->where('status', 'Izin')->count();
        $countAlfa = $totalAttendance->where('status', 'Alfa')->count();
        $countTerlambat = $totalAttendance->where('status', 'Terlambat')->count();
        $countTAP = $totalAttendance->where('status', 'TAP')->count();

        // Calculate percentages based on total number of students
        $percentageHadir = ($totalStudents > 0) ? ($countHadir / $totalStudents) * 100 : 0;
        $percentageSakitIzin = ($totalStudents > 0) ? ($countSakitIzin / $totalStudents) * 100 : 0;
        $percentageAlfa = ($totalStudents > 0) ? ($countAlfa / $totalStudents) * 100 : 0;
        $percentageTerlambat = ($totalStudents > 0) ? ($countTerlambat / $totalStudents) * 100 : 0;
        $percentageTAP = ($totalStudents > 0) ? ($countTAP / $totalStudents) * 100 : 0;

        // Handle date range for the report
        $startDate = $request->input('start');
        $endDate = $request->input('end');

        // Set default to the current month if no dates are provided
        if (!$startDate || !$endDate) {
            $startDate = Carbon::now()->startOfMonth()->toDateString();
            $endDate = Carbon::now()->endOfMonth()->toDateString();
        }

        // Query attendance data within the date range
        $query = Absensi::whereIn('nis', $nis)
            ->whereBetween('date', [$startDate, $endDate])
            ->orderBy('date', 'asc')
            ->get();

        // Group data by date and calculate status counts
        $chartStatusCount = $query->groupBy('date')->map(function ($dayDatas) use ($totalStudents) {
            $totalCount = $dayDatas->count();
            $statusCounts = $dayDatas->groupBy('status')->map->count();

            // Calculate percentage for each status based on total students
            $percentages = $statusCounts->map(function ($count) use ($totalStudents) {
                return ($totalStudents > 0) ? number_format(($count / $totalStudents) * 100, 2) : 0;
            });

            // Calculate the total 'Tidak Hadir' (absent) count
            $tidakHadirCount = $statusCounts->get('Alfa', 0) + $statusCounts->get('Sakit', 0) + $statusCounts->get('Izin', 0);

            $statusCounts['TidakHadir'] = $tidakHadirCount;
            $percentages['TidakHadir'] = ($tidakHadirCount > 0) ? number_format(($tidakHadirCount / $totalStudents) * 100, 2) : 0;

            return [
                'counts' => $statusCounts, // Actual counts
                'percentages' => $percentages // Percentages
            ]; // Return the status percentages
        });

        return view('walikelas.walikelas', compact(
            'countHadir',
            'countSakitIzin',
            'countAlfa',
            'countTerlambat',
            'countTAP',
            'percentageHadir',
            'percentageSakitIzin',
            'percentageAlfa',
            'percentageTerlambat',
            'percentageTAP',
            'chartStatusCount',
            'startDate',
            'endDate',
        ));
    }

    public function laporanSiswa(Request $request)
    {
        // Retrieve the date range from the request
        $startDate = $request->input('start');
        $endDate = $request->input('end');

        // Set default to the current month if no dates are provided
        if (!$startDate || !$endDate) {
            $startDate = Carbon::now()->startOfMonth()->toDateString();
            $endDate = Carbon::now()->endOfMonth()->toDateString();
        }

        // Calculate the number of business days in the date range
        $businessDaysCount = $this->getBusinessDaysCount($startDate, $endDate);

        // Fetch students in the class
        $user = Auth::user();
        $nuptk = $user->wali->nuptk;
        $class = Kelas::where("nuptk", $nuptk)->first();
        $students = Siswa::where('id_kelas', $class->id_kelas)->with('user')->get();
        $siswaIds = $students->pluck('nis');

        // Fetch attendance records for the students within the specified date range
        $siswaAbsensi = Absensi::whereIn('nis', $siswaIds)
            ->whereBetween('date', [$startDate, $endDate])
            ->get();

        $totalStudents = count($students);
        $attendanceCounts = [
            'Hadir' => $siswaAbsensi->where('status', 'Hadir')->count(),
            'Sakit' => $siswaAbsensi->where('status', 'Sakit')->count(),
            'Izin' => $siswaAbsensi->where('status', 'Izin')->count(),
            'Alfa' => $siswaAbsensi->where('status', 'Alfa')->count(),
            'Terlambat' => $siswaAbsensi->where('status', 'Terlambat')->count(),
            'TAP' => $siswaAbsensi->where('status', 'TAP')->count(),
        ];

        // Calculate the percentage of attendance for each student based on business days
        $studentsData = [];
        foreach ($students as $student) {
            // Get attendance records for the current student within the specified date range
            $studentAttendance = $siswaAbsensi->where('nis', $student->nis);
            $studentData = [
                'nis' => $student->nis,
                'name' => $student->user->nama,
                'attendancePercentages' => [],
            ];

            // Calculate percentage for each status based on business days
            foreach ($attendanceCounts as $status => $count) {
                $studentStatusCount = $studentAttendance->where('status', $status)->count();
                $percentage = $businessDaysCount > 0 ? ($studentStatusCount / $businessDaysCount) * 100 : 0;
                $studentData['attendancePercentages'][$status] = $percentage;
            }

            $studentsData[] = $studentData;
        }

        // Calculate average attendance percentages for all statuses based on business days
        $averageAttendancePercentages = [];
        $attendanceCounts['Sakit/Izin'] = $attendanceCounts['Sakit'] + $attendanceCounts['Izin'];

        foreach ($attendanceCounts as $status => $count) {
            $totalPercentage = 0;

            foreach ($studentsData as $studentData) {
                if ($status === 'Sakit/Izin') {
                    $totalPercentage += $studentData['attendancePercentages']['Sakit'] ?? 0;
                    $totalPercentage += $studentData['attendancePercentages']['Izin'] ?? 0;
                } else {
                    $totalPercentage += $studentData['attendancePercentages'][$status] ?? 0;
                }
            }

            // Calculate the average percentage based on the total number of students and business days
            $averageAttendancePercentages[$status] = $totalStudents > 0 ? $totalPercentage / $totalStudents : 0;
        }

        // Paginate the data
        $siswaDataCollection = collect($studentsData);
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 10;
        $paginateData = new LengthAwarePaginator(
            $siswaDataCollection->forPage($currentPage, $perPage),
            $siswaDataCollection->count(),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );

        $paginatedData = $paginateData->appends($request->only(['start', 'end']));

        // Pass the data to the view
        return view('walikelas.siswa', [
            'studentsData' => $paginatedData,
            'attendanceCounts' => $attendanceCounts,
            'averageAttendancePercentages' => $averageAttendancePercentages,
            'kelas' => $class,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'businessDaysCount' => $businessDaysCount,
        ]);
    }

    
    
    public function detailSiswa(Request $request, $id)
    {
        // Retrieve the date range from the request
        $startDate = $request->input('start');
        $endDate = $request->input('end');

        // Set default to the current month if no dates are provided
        if (!$startDate || !$endDate) {
            $startDate = Carbon::now()->startOfMonth()->toDateString();
            $endDate = Carbon::now()->endOfMonth()->toDateString();
        }

        $present = Absensi::where('nis', $id)->whereBetween('date', [$startDate, $endDate])->orderBy('date', 'asc')->get();
        
        $students = Siswa::where('nis', $id)->with('user')->first();


        $totalRecords = $present->count();

        $attendanceCounts = [
            'Hadir' => $present->where('status', 'Hadir')->count(),
            'Sakit/Izin' => $present->where('status', 'Sakit')->count() + $present->where('status', 'Izin')->count(),
            // 'Izin' => $present->where('status', 'Izin')->count(),
            'Alfa' => $present->where('status', 'Alfa')->count(),
            'Terlambat' => $present->where('status', 'Terlambat')->count(),
            'TAP' => $present->where('status', 'TAP')->count(),
        ];

        $businessDaysCount = $this->getBusinessDaysCount($startDate, $endDate);

        $attendancePercentage = [
            'percentageHadir' => ($businessDaysCount > 0) ? ($attendanceCounts['Hadir'] / $businessDaysCount) * 100 : 0,
            'percentageSakitIzin' => ($businessDaysCount > 0) ? ($attendanceCounts['Sakit/Izin'] / $businessDaysCount) * 100 : 0,
            'percentageAlfa' => ($businessDaysCount > 0) ? ($attendanceCounts['Alfa'] / $businessDaysCount) * 100 : 0,
            'percentageTerlambat' => ($businessDaysCount > 0) ? ($attendanceCounts['Terlambat'] / $businessDaysCount) * 100 : 0,
            'percentageTAP' => ($businessDaysCount > 0) ? ($attendanceCounts['TAP'] / $businessDaysCount) * 100 : 0,
        ];

        $presentDataCollection = collect($present);
        
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 10;
        $paginateData = new LengthAwarePaginator(
            $presentDataCollection->forPage($currentPage, $perPage),
            $presentDataCollection->count(),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );

        $paginatedData = $paginateData->appends($request->only(['start', 'end']));

        return view('walikelas.detailsiswa', [
            'present' => $paginatedData,
            'students' => $students,
            'attendanceCounts' => $attendanceCounts,
            'attendancePercentage' => $attendancePercentage,
            'startDate' => $startDate,
            'endDate' => $endDate
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

    public function listsiswa()
    {
        return view('wali.listsiswa', [
            "title" => "Absen Siswa"
        ]);
    }
}
