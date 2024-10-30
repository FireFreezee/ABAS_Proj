<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
        $nip = $user->wali->nip;

        // Find the class associated with the user
        $class = Kelas::where("nip", $nip)->first();

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
        $countHadir = $totalAttendance->where('status', 'Hadir')->count() + $totalAttendance->where('status', 'Terlambat')->count() + $totalAttendance->where('status', 'TAP')->count();
        $countSakitIzin = $totalAttendance->where('status', 'Sakit')->count() + $totalAttendance->where('status', 'Izin')->count();
        $countAlfa = $totalAttendance->where('status', 'Alfa')->count();
        // $countTerlambat = $totalAttendance->where('status', 'Terlambat')->count();
        // $countTAP = $totalAttendance->where('status', 'TAP')->count();

        // Calculate percentages based on total number of students
        $percentageHadir = ($totalStudents > 0) ? ($countHadir / $totalStudents) * 100 : 0;
        $percentageSakitIzin = ($totalStudents > 0) ? ($countSakitIzin / $totalStudents) * 100 : 0;
        $percentageAlfa = ($totalStudents > 0) ? ($countAlfa / $totalStudents) * 100 : 0;

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
            $HadirCount = $statusCounts->get('Hadir', 0) + $statusCounts->get('Terlambat', 0) + $statusCounts->get('TAP', 0);

            $statusCounts['Hadir'] = $HadirCount;
            $percentages['Hadir'] = ($HadirCount > 0) ? number_format(($HadirCount / $totalStudents) * 100, 2) : 0;            

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
        $search = $request->input('search');

        // Set default to the current month if no dates are provided
        if (!$startDate || !$endDate) {
            $startDate = Carbon::now()->startOfMonth()->toDateString();
            $endDate = Carbon::now()->endOfMonth()->toDateString();
        }

        // Fetch students in the class
        $user = Auth::user();
        $nip = $user->wali->nip;
        $class = Kelas::where("nip", $nip)->first();
        $studentsQuery = Siswa::where('id_kelas', $class->id_kelas)->with('user');

        if ($search) {
            $studentsQuery->where(function ($query) use ($search) {
                $query->where('nis', 'like', '%' . $search . '%')
                    ->orWhereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('nama', 'like', '%' . $search . '%');
                    });
            });
        }

        // Get the students and their IDs
        $students = $studentsQuery->get();
        $siswaIds = $students->pluck('nis');

        // Fetch attendance records for the students within the specified date range
        $siswaAbsensi = Absensi::whereIn('nis', $siswaIds)
            ->whereBetween('date', [$startDate, $endDate])
            ->get();

        // Initialize the attendance count for each status across all students
        $attendanceCounts = [
            'Hadir' => $siswaAbsensi->whereIn('status', ['Hadir', 'Terlambat', 'TAP'])->count(),
            'Sakit/Izin' => $siswaAbsensi->whereIn('status', ['Sakit', 'Izin'])->count(),
            'Alfa' => $siswaAbsensi->where('status', 'Alfa')->count(),
        ];

        // Calculate attendance data for each student
        $studentsData = [];

        foreach ($students as $student) {
            // Get attendance records for the current student within the specified date range
            $studentAttendance = $siswaAbsensi->where('nis', $student->nis);

            // Calculate the Effective Business Day Count based on unique attendance dates
            $effectiveBusinessDaysCount = $studentAttendance->unique('date')->count();

            // Initialize the student data
            $studentData = [
                'nis' => $student->nis,
                'name' => $student->user->nama,
                'attendanceCounts' => [],
                'attendancePercentages' => [],
            ];

            // Count the status for this student
            foreach ($attendanceCounts as $status => $count) {
                if ($status === 'Hadir') {
                    // Count the combined status for 'Hadir'
                    $studentStatusCount = $studentAttendance->whereIn('status', ['Hadir', 'Terlambat', 'TAP'])->count();
                } elseif ($status === 'Sakit/Izin') {
                    // Count the combined status for 'Sakit/Izin'
                    $studentStatusCount = $studentAttendance->whereIn('status', ['Sakit', 'Izin'])->count();
                } else {
                    // Count for individual statuses
                    $studentStatusCount = $studentAttendance->where('status', $status)->count();
                }

                $studentData['attendanceCounts'][$status] = $studentStatusCount; // Count for this status

                // Calculate the percentage based on Effective Business Days Count
                if ($effectiveBusinessDaysCount > 0) {
                    $percentage = ($studentStatusCount / $effectiveBusinessDaysCount) * 100;
                    $studentData['attendancePercentages'][$status] = $percentage;
                } else {
                    $studentData['attendancePercentages'][$status] = 0; // Set to 0 if no effective days
                }
            }

            $studentsData[] = $studentData; // Add student data to the array
        }

        // Calculate average attendance percentages for all statuses
        $averageAttendancePercentages = [];
        $totalStudents = count($students);
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

        $paginatedData = $paginateData->appends($request->only(['start', 'end']));

        // Pass the data to the view
        return view('walikelas.siswa', [
            'studentsData' => $paginatedData,
            'attendanceCounts' => $attendanceCounts,
            'averageAttendancePercentages' => $averageAttendancePercentages,
            'kelas' => $class,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'businessDaysCount' => $effectiveBusinessDaysCount,
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
            'Hadir' => $present->where('status', 'Hadir')->count() + $present->where('status', 'Terlambat')->count() + $present->where('status', 'TAP')->count(),
            'Sakit/Izin' => $present->where('status', 'Sakit')->count() + $present->where('status', 'Izin')->count(),
            // 'Izin' => $present->where('status', 'Izin')->count(),
            'Alfa' => $present->where('status', 'Alfa')->count(),
            // 'Terlambat' => $present->where('status', 'Terlambat')->count(),
            // 'TAP' => $present->where('status', 'TAP')->count(),
        ];

        $effectiveBusinessDaysCount = $present->unique('date')->count();

        $attendancePercentage = [
            'percentageHadir' => ($effectiveBusinessDaysCount > 0) ? ($attendanceCounts['Hadir'] / $effectiveBusinessDaysCount) * 100 : 0,
            'percentageSakitIzin' => ($effectiveBusinessDaysCount > 0) ? ($attendanceCounts['Sakit/Izin'] / $effectiveBusinessDaysCount) * 100 : 0,
            'percentageAlfa' => ($effectiveBusinessDaysCount > 0) ? ($attendanceCounts['Alfa'] / $effectiveBusinessDaysCount) * 100 : 0,
            // 'percentageTerlambat' => ($businessDaysCount > 0) ? ($attendanceCounts['Terlambat'] / $businessDaysCount) * 100 : 0,
            // 'percentageTAP' => ($businessDaysCount > 0) ? ($attendanceCounts['TAP'] / $businessDaysCount) * 100 : 0,
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

    public function profile()
    {
        return view("Walikelas.profile");
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
            return redirect()->route('walikelas-dashboard')->with('success', "Data Berhasil di Update");
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

    public function listsiswa()
    {
        return view('wali.listsiswa', [
            "title" => "Absen Siswa"
        ]);
    }
}
