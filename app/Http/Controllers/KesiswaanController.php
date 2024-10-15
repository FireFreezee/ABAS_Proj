<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Wali_Kelas;
use App\Models\Siswa;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

class KesiswaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $currentDay = now()->day;
        $currentMonth = now()->month;
        $currentYear = now()->year;

        // Fetch all classes
        // $kelasList = Kelas::with('siswa.absensi')->get();

        // Get total attendance data for all classes in the current month
        $totalAbsensi = Absensi::where('date', date('(Y-m-d)'))->get();

        // Calculate total counts and percentages for all classes
        $totalRecords = $totalAbsensi->count();

        $countHadir = $totalAbsensi->where('status', 'Hadir')->count();
        $countSakitIzin = ($totalAbsensi->where('status', 'Sakit')->count()) + ($totalAbsensi->where('status', 'Izin')->count());
        $countAlfa = $totalAbsensi->where('status', 'Alfa')->count();
        $countTerlambat = $totalAbsensi->where('status', 'Terlambat')->count();
        $countTAP = $totalAbsensi->where('status', 'TAP')->count();

        $percentageHadir = ($totalRecords > 0) ? ($countHadir / $totalRecords) * 100 : 0;
        $percentageSakitIzin = ($totalRecords > 0) ? ($countSakitIzin / $totalRecords) * 100 : 0;
        $percentageAlfa = ($totalRecords > 0) ? ($countAlfa / $totalRecords) * 100 : 0;
        $percentageTerlambat = ($totalRecords > 0) ? ($countTerlambat / $totalRecords) * 100 : 0;
        $percentageTAP = ($totalRecords > 0) ? ($countTAP / $totalRecords) * 100 : 0;

        $startDate = $request->input('start');
        $endDate = $request->input('end');

        // Set default to current month if no dates are provided
        if (!$startDate || !$endDate) {
            $startDate = Carbon::now()->startOfMonth()->toDateString();
            $endDate = Carbon::now()->endOfMonth()->toDateString();
        }

        // Apply date range filtering
        $query = Absensi::whereBetween('date', [$startDate, $endDate]);

        $filteredData = $query->orderBy('date', 'asc')->get();

        // Group by date and then by status, counting each combination
        $dailyStatusCounts = $filteredData->groupBy('date')->map(function ($dayData) { 
            $totalCount = $dayData->count(); 
            $statusCounts = $dayData->groupBy('status')->map->count(); 
        
            // Calculate percentage for each status
            $percentages = $statusCounts->map(function ($count) use ($totalCount) {
                return ($totalCount > 0) ? number_format(($count / $totalCount) * 100, 2 ) : 0;
            });
        
            return $percentages; // Return the status percentages
        });

        return view('kesiswaan.kesiswaan', [
            'title' => 'Dashboard',
            'countHadir' => $countHadir,
            'countSakitIzin' => $countSakitIzin,
            'countAlfa' => $countAlfa,
            'countTerlambat' => $countTerlambat,
            'countTAP' => $countTAP,
            'percentageHadir' => $percentageHadir,
            'percentageSakitIzin' => $percentageSakitIzin,
            'percentageAlfa' => $percentageAlfa,
            'percentageTerlambat' => $percentageTerlambat,
            'percentageTAP' => $percentageTAP,
            'dailyStatusCounts' => $dailyStatusCounts,
            'startDate' => $startDate,
            'endDate' => $endDate
        ]);
    }

    public function laporanKelas(Request $request)
    {
        // Retrieve the date range from the request
        $startDate = $request->input('start');
        $endDate = $request->input('end');

        // Set default to current month if no dates are provided
        if (!$startDate || !$endDate) {
            $startDate = Carbon::now()->startOfMonth()->toDateString();
            $endDate = Carbon::now()->endOfMonth()->toDateString();
        }

        // Fetch all classes
        $kelasList = Kelas::with('siswa.absensi')->get();

        $kelasData = [];
        $totalPercentageHadir = 0;
        $totalClasses = count($kelasList);

        foreach ($kelasList as $kelas) {
            $siswaIds = $kelas->siswa->pluck('nis');

            // Modify the query to filter by date range
            $kelasAbsensi = Absensi::whereBetween('date', [$startDate, $endDate])
                ->whereIn('nis', $siswaIds)
                ->get();

            $totalKelasRecords = $kelasAbsensi->count();

            $kelasHadir = $kelasAbsensi->where('status', 'Hadir')->count();
            $kelasSakitIzin = ($kelasAbsensi->where('status', 'Sakit')->count()) + ($kelasAbsensi->where('status', 'Izin')->count());
            $kelasAlfa = $kelasAbsensi->where('status', 'Alfa')->count();
            $kelasTerlambat = $kelasAbsensi->where('status', 'Terlambat')->count();
            $kelasTAP = $kelasAbsensi->where('status', 'TAP')->count();

            // Calculate percentages for the class
            $kelasPercentageHadir = ($totalKelasRecords > 0) ? ($kelasHadir / $totalKelasRecords) * 100 : 0;
            $totalPercentageHadir += $kelasPercentageHadir;
            $kelasPercentageSakitIzin = ($totalKelasRecords > 0) ? ($kelasSakitIzin / $totalKelasRecords) * 100 : 0;
            $kelasPercentageAlfa = ($totalKelasRecords > 0) ? ($kelasAlfa / $totalKelasRecords) * 100 : 0;
            $kelasPercentageTerlambat = ($totalKelasRecords > 0) ? ($kelasTerlambat / $totalKelasRecords) * 100 : 0;
            $kelasPercentageTAP = ($totalKelasRecords > 0) ? ($kelasTAP / $totalKelasRecords) * 100 : 0;

            $kelasData[] = [
                'kelas_id' => $kelas->id_kelas,
                'kelas' => $kelas->tingkat . ' ' . $kelas->id_jurusan . '' . $kelas->nomor_kelas,
                'total' => $totalKelasRecords,
                'countHadir' => $kelasHadir,
                'percentageHadir' => $kelasPercentageHadir,
                'countSakitIzin' => $kelasSakitIzin,
                'percentageSakitIzin' => $kelasPercentageSakitIzin,
                'countAlfa' => $kelasAlfa,
                'percentageAlfa' => $kelasPercentageAlfa,
                'countTerlambat' => $kelasTerlambat,
                'percentageTerlambat' => $kelasPercentageTerlambat,
                'countTAP' => $kelasTAP,
                'percentageTAP' => $kelasPercentageTAP,
            ];
        }
        $averagePercentageHadir = ($totalClasses > 0) ? ($totalPercentageHadir / $totalClasses) : 0;

        $kelasDataCollection = collect($kelasData);

        // Paginate the collection
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 10;
        $paginateData = new LengthAwarePaginator(
            $kelasDataCollection->forPage($currentPage, $perPage),
            $kelasDataCollection->count(),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );

        $paginatedData = $paginateData->appends($request->only(['start', 'end']));
        
        return view('kesiswaan.kelas', [
            'title' => 'Dashboard',
            'kelasData' => $paginatedData,
            'averagePercentageHadir' => $averagePercentageHadir,
            'startDate' => $startDate,
            'endDate' => $endDate,
        ]);
    }

    public function laporanSiswa(Request $request, $kelas_id)
    {
        // Retrieve the date range from the request
        $startDate = $request->input('start');
        $endDate = $request->input('end');

        // Set default to the current month if no dates are provided
        if (!$startDate || !$endDate) {
            $startDate = Carbon::now()->startOfMonth()->toDateString();
            $endDate = Carbon::now()->endOfMonth()->toDateString();
        }

        // Fetch students in the class
        $kelas = Kelas::where('id_kelas', $kelas_id)->first();
        $students = Siswa::where('id_kelas', $kelas_id)->with('user')->get();
        $siswaIds = $students->pluck('nis');

        // Fetch attendance records for the students within the specified date range
        $siswaAbsensi = Absensi::whereIn('nis', $siswaIds)
            ->whereBetween('date', [$startDate, $endDate]) // Filter by date range
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
        // Calculate the percentage of attendance for each student

        $studentsData = []; // Initialize the array to hold student data

        foreach ($students as $student) {
            // Get attendance records for the current student within the specified date range
            $studentAttendance = $siswaAbsensi->where('nis', $student->nis);

            $totalAttendance = $studentAttendance->count();
            $studentData = [
                'nis' => $student->nis,
                'name' => $student->user->nama,
                'attendancePercentages' => [],
            ];

            if ($totalAttendance > 0) {
                foreach ($attendanceCounts as $status => $count) {
                    $studentStatusCount = $studentAttendance->where('status', $status)->count();
                    $percentage = ($studentStatusCount / $totalAttendance) * 100;
                    $studentData['attendancePercentages'][$status] = $percentage;
                }
            } else {
                // If no attendance records, set all percentages to 0
                $studentData['attendancePercentages'] = array_fill_keys(array_keys($attendanceCounts), 0);
            }

            $studentsData[] = $studentData; // Add student data to the array
        }

        // Calculate average attendance percentages for all statuses
        $averageAttendancePercentages = [];

        // Combine 'Sakit' and 'Izin' for average calculations
        $attendanceCounts['Sakit/Izin'] = $attendanceCounts['Sakit'] + $attendanceCounts['Izin'];

        foreach ($attendanceCounts as $status => $count) {
            $totalPercentage = 0;

            // Sum the individual percentages for this status
            foreach ($studentsData as $studentData) {
                // Check if the status is 'Sakit/Izin' and combine values
                if ($status === 'Sakit/Izin') {
                    $totalPercentage += $studentData['attendancePercentages']['Sakit'] ?? 0;
                    $totalPercentage += $studentData['attendancePercentages']['Izin'] ?? 0;
                } else {
                    $totalPercentage += $studentData['attendancePercentages'][$status] ?? 0;
                }
            }

            // Calculate the average percentage
            $averageAttendancePercentages[$status] = $totalStudents > 0 ? $totalPercentage / $totalStudents : 0;
        }

        $siswaDataCollection = collect($studentsData);

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 10;
        $paginateData = new LengthAwarePaginator(
        $siswaDataCollection->forPage($currentPage, $perPage),
        $siswaDataCollection->count(),
        $perPage, 
        $currentPage, 
        ['path'=> LengthAwarePaginator::resolveCurrentPath()]
        );

        $paginatedData = $paginateData->appends($request->only(['start','end']));

        // Pass the data to the view
        return view('kesiswaan.siswa', [
            'studentsData' => $paginatedData,
            'attendanceCounts' => $attendanceCounts, 
            'averageAttendancePercentages' => $averageAttendancePercentages, 
            'kelas' => $kelas, 
            'startDate' => $startDate, 
            'endDate' => $endDate
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

        $attendancePercentage = [
            'percentageHadir' => ($totalRecords > 0) ? ($attendanceCounts['Hadir'] / $totalRecords) * 100 : 0,
            'percentageSakitIzin' => ($totalRecords > 0) ? ($attendanceCounts['Sakit/Izin'] / $totalRecords) * 100 : 0,
            'percentageAlfa' => ($totalRecords > 0) ? ($attendanceCounts['Alfa'] / $totalRecords) * 100 : 0,
            'percentageTerlambat' => ($totalRecords > 0) ? ($attendanceCounts['Terlambat'] / $totalRecords) * 100 : 0,
            'percentageTAP' => ($totalRecords > 0) ? ($attendanceCounts['TAP'] / $totalRecords) * 100 : 0,
        ];

        $presentDataCollection = collect($present);

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 10;
        $paginateData = new LengthAwarePaginator(
            $presentDataCollection->forPage($currentPage, $perPage),
            $presentDataCollection->count(),
            $perPage,
            $currentPage,
            ['path'=> LengthAwarePaginator::resolveCurrentPath()]
        );

        $paginatedData = $paginateData->appends($request->only(['start','end']));

        return view('kesiswaan.detailsiswa', [
            'present' => $paginatedData ,
            'students' => $students,
            'attendanceCounts' => $attendanceCounts,
            'attendancePercentage' =>$attendancePercentage, 
            'startDate' => $startDate, 
            'endDate' => $endDate
        ]);
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
