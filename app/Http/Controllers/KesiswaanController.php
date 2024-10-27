<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Jurusan;
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
        $currentDay = Carbon::now()->format("Y-m-d");

        // Fetch all classes
        // $kelasList = Kelas::with('siswa.absensi')->get();

        // Get total attendance data for all classes in the current month
        $totalAbsensi = Absensi::where('date', $currentDay)->get();

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
                return ($totalCount > 0) ? number_format(($count / $totalCount) * 100, 2) : 0;
            });

            $tidakHadirCount = $statusCounts->get('Alfa', 0) + $statusCounts->get('Sakit', 0) + $statusCounts->get('Izin', 0);
            $percentages['TidakHadir'] = ($tidakHadirCount > 0) ? number_format(($tidakHadirCount / $totalCount) * 100, 2) : 0;

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
        $tingkat = $request->input('tingkat');
        $jurusan = $request->input('jurusan');

        // Set default to current month if no dates are provided
        if (!$startDate || !$endDate) {
            $startDate = Carbon::now()->startOfMonth()->toDateString();
            $endDate = Carbon::now()->endOfMonth()->toDateString();
        }

        $totalBusinessDays = $this->getBusinessDaysCount($startDate, $endDate);

        $kelasQuery = Kelas::with('siswa.absensi');
        $jurusans = Jurusan::all();

        if ($tingkat) {
            $kelasQuery->where('tingkat', $tingkat);
        }

        if ($jurusan) {
            $kelasQuery->where('id_jurusan', $jurusan);
        }

        $kelasList = $kelasQuery->get();
        $kelasData = [];
        $totalPercentageHadir = 0;
        $totalClasses = count($kelasList);

        foreach ($kelasList as $kelas) {
            $siswaIds = $kelas->siswa->pluck('nis');
            $totalExpectedRecords = $totalBusinessDays * count($siswaIds);

            $kelasAbsensi = Absensi::whereBetween('date', [$startDate, $endDate])
                ->whereIn('nis', $siswaIds)
                ->get();

            $kelasHadir = $kelasAbsensi->where('status', 'Hadir')->count();
            $kelasSakitIzin = $kelasAbsensi->whereIn('status', ['Sakit', 'Izin'])->count();
            $kelasAlfa = $kelasAbsensi->where('status', 'Alfa')->count();
            $kelasTerlambat = $kelasAbsensi->where('status', 'Terlambat')->count();
            $kelasTAP = $kelasAbsensi->where('status', 'TAP')->count();

            // Calculate percentages for the class based on total expected records
            $kelasPercentageHadir = ($totalExpectedRecords > 0) ? ($kelasHadir / $totalExpectedRecords) * 100 : 0;
            $totalPercentageHadir += $kelasPercentageHadir;
            $kelasPercentageSakitIzin = ($totalExpectedRecords > 0) ? ($kelasSakitIzin / $totalExpectedRecords) * 100 : 0;
            $kelasPercentageAlfa = ($totalExpectedRecords > 0) ? ($kelasAlfa / $totalExpectedRecords) * 100 : 0;
            $kelasPercentageTerlambat = ($totalExpectedRecords > 0) ? ($kelasTerlambat / $totalExpectedRecords) * 100 : 0;
            $kelasPercentageTAP = ($totalExpectedRecords > 0) ? ($kelasTAP / $totalExpectedRecords) * 100 : 0;

            $kelasData[] = [
                'kelas_id' => $kelas->id_kelas,
                'kelas' => $kelas->tingkat . ' ' . $kelas->id_jurusan . ' ' . $kelas->nomor_kelas,
                'total' => $totalExpectedRecords,
                'jurusan' => $kelas->id_jurusan,
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
            'jurusans' => $jurusans
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

        $businessDaysCount = $this->getBusinessDaysCount($startDate, $endDate);

        // Fetch the search keyword for name or NIS
        $search = $request->input('search');

        // Fetch students in the class and apply search filter
        $kelas = Kelas::where('id_kelas', $kelas_id)->first();
        $studentsQuery = Siswa::where('id_kelas', $kelas_id)->with('user');

        if ($search) {
            // Filter by name or NIS
            $studentsQuery->whereHas('user', function ($query) use ($search) {
                $query->where('nama', 'like', '%' . $search . '%');
            })->orWhere('nis', 'like', '%' . $search . '%');
        }

        $students = $studentsQuery->get();
        $siswaIds = $students->pluck('nis');

        // Fetch attendance records for the students within the specified date range
        $siswaAbsensi = Absensi::whereIn('nis', $siswaIds)
            ->whereBetween('date', [$startDate, $endDate])
            ->get();

        $totalStudents = count($students);
        $attendanceCounts = [
            'Hadir' => $siswaAbsensi->where('status', 'Hadir')->count(),
            'Sakit/Izin' => $siswaAbsensi->whereIn('status', ['Sakit', 'Izin'])->count(), // Combined status
            'Alfa' => $siswaAbsensi->where('status', 'Alfa')->count(),
            'Terlambat' => $siswaAbsensi->where('status', 'Terlambat')->count(),
            'TAP' => $siswaAbsensi->where('status', 'TAP')->count(),
        ];

        // Calculate the percentage of attendance for each student
        $studentsData = []; // Initialize the array to hold student data

        foreach ($students as $student) {
            // Get attendance records for the current student within the specified date range
            $studentAttendance = $siswaAbsensi->where('nis', $student->nis);

            // Initialize the student data
            $studentData = [
                'nis' => $student->nis,
                'name' => $student->user->nama,
                'attendanceCounts' => [],
                'attendancePercentages' => [],
            ];

            // Count the status for this student
            foreach ($attendanceCounts as $status => $count) {
                if ($status === 'Sakit/Izin') {
                    // Calculate the count for combined status
                    $studentStatusCount = $studentAttendance->whereIn('status', ['Sakit', 'Izin'])->count();
                } else {
                    // Calculate count for individual statuses
                    $studentStatusCount = $studentAttendance->where('status', $status)->count();
                }

                $studentData['attendanceCounts'][$status] = $studentStatusCount; // Count for this status

                // Calculate the percentage for this status
                if ($businessDaysCount > 0) {
                    $percentage = ($studentStatusCount / $businessDaysCount) * 100;
                    $studentData['attendancePercentages'][$status] = $percentage;
                } else {
                    $studentData['attendancePercentages'][$status] = 0; // Set to 0 if no business days
                }
            }

            $studentsData[] = $studentData; // Add student data to the array
        }

        // Calculate average attendance percentages for all statuses
        $averageAttendancePercentages = [];
        foreach ($attendanceCounts as $status => $count) {
            $totalPercentage = 0;

            // Sum the individual percentages for this status
            foreach ($studentsData as $studentData) {
                $totalPercentage += $studentData['attendancePercentages'][$status] ?? 0;
            }

            // Calculate the average percentage
            $averageAttendancePercentages[$status] = $totalStudents > 0 ? $totalPercentage / $totalStudents : 0;
        }

        // Create a pagination instance
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

        $paginatedData = $paginateData->appends($request->only(['start', 'end', 'search']));

        // Pass the data to the view
        return view('kesiswaan.siswa', [
            'studentsData' => $paginatedData,
            'attendanceCounts' => $attendanceCounts,
            'averageAttendancePercentages' => $averageAttendancePercentages,
            'kelas' => $kelas,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'search' => $search
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

        return view('kesiswaan.detailsiswa', [
            'present' => $paginatedData,
            'students' => $students,
            'attendanceCounts' => $attendanceCounts,
            'attendancePercentage' => $attendancePercentage,
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
