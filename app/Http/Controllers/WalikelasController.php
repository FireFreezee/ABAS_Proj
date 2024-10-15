<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Kelas;
use App\Models\Siswa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WalikelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $currentDay = now()->day;
        // $currentMonth = now()->month;
        // $currentYear = now()->year;

        $user = Auth::user();
        $nuptk = $user->wali->nuptk;

        $class = Kelas::where("nuptk", $nuptk)->first();

        $student = Siswa::where("id_kelas", $class->id_kelas)->get();
        $nis = $student->pluck('nis');

        $totalAttendance = Absensi::whereIn('nis', $nis)
        ->where('date', date('(Y-m-d)')) 
        ->get();

        $totalRecords = $totalAttendance->count();

        $countHadir = $totalAttendance->where('status', 'Hadir')->count();
        $countSakitIzin = ($totalAttendance->where('status', 'Sakit')->count()) + ($totalAttendance->where('status', 'Izin')->count());
        $countAlfa = $totalAttendance->where('status', 'Alfa')->count();
        $countTerlambat = $totalAttendance->where('status', 'Terlambat')->count();
        $countTAP = $totalAttendance->where('status', 'TAP')->count();
        
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

        $query = Absensi::whereIn('nis', $nis)
        ->whereBetween('date', [$startDate, $endDate])
        ->orderBy('date','asc')
        ->get();

        $chartStatusCount = $query->groupBy('date')->map(function($dayDatas) {
            $totalCount = $dayDatas->count(); 
            $statusCounts = $dayDatas->groupBy('status')->map->count(); 
        
            // Calculate percentage for each status
            $percentages = $statusCounts->map(function ($count) use ($totalCount) {
                return ($totalCount > 0) ? number_format(($count / $totalCount) * 100, 2 ) : 0;
            });
        
            return $percentages; // Return the status percentages
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
