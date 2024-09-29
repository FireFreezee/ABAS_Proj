<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Kelas;
use Illuminate\Http\Request;

class WalikelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currentMonth = now()->month;
        $currentYear = now()->year;

        // Fetch all classes
        $kelasList = Kelas::with('siswa.absensi')->get();

        // Get total attendance data for all classes in the current month
        $totalAbsensi = Absensi::whereYear('date', $currentYear)
            ->whereMonth('date', $currentMonth)
            ->get();

        // Calculate total counts and percentages for all classes
        $totalRecords = $totalAbsensi->count();

        $countHadir = $totalAbsensi->where('status', 'Hadir')->count();
        $countSakit = $totalAbsensi->where('status', 'Sakit')->count();
        $countIzin = $totalAbsensi->where('status', 'Izin')->count();
        $countAlfa = $totalAbsensi->where('status', 'Alfa')->count();
        $countTerlambat = $totalAbsensi->where('status', 'Terlambat')->count();
        $countTAP = $totalAbsensi->where('status', 'TAP')->count();

        $percentageHadir = ($totalRecords > 0) ? ($countHadir / $totalRecords) * 100 : 0;
        $percentageSakit = ($totalRecords > 0) ? ($countSakit / $totalRecords) * 100 : 0;
        $percentageIzin = ($totalRecords > 0) ? ($countIzin / $totalRecords) * 100 : 0;
        $percentageAlfa = ($totalRecords > 0) ? ($countAlfa / $totalRecords) * 100 : 0;
        $percentageTerlambat = ($totalRecords > 0) ? ($countTerlambat / $totalRecords) * 100 : 0;
        $percentageTAP = ($totalRecords > 0) ? ($countTAP / $totalRecords) * 100 : 0;

        // Store attendance statistics for each class
        $kelasData = [];
        foreach ($kelasList as $kelas) {
            $siswaIds = $kelas->siswa->pluck('nis');
            $kelasAbsensi = Absensi::whereYear('date', $currentYear)
                ->whereMonth('date', $currentMonth)
                ->whereIn('nis', $siswaIds)
                ->get();

            $totalKelasRecords = $kelasAbsensi->count();

            $kelasHadir = $kelasAbsensi->where('status', 'Hadir')->count();
            $kelasSakit = $kelasAbsensi->where('status', 'Sakit')->count();
            $kelasIzin = $kelasAbsensi->where('status', 'Izin')->count();
            $kelasAlfa = $kelasAbsensi->where('status', 'Alfa')->count();
            $kelasTerlambat = $kelasAbsensi->where('status', 'Terlambat')->count();
            $kelasTAP = $kelasAbsensi->where('status', 'TAP')->count();

            // Calculate percentages for the class
            $kelasPercentageHadir = ($totalKelasRecords > 0) ? ($kelasHadir / $totalKelasRecords) * 100 : 0;
            $kelasPercentageSakit = ($totalKelasRecords > 0) ? ($kelasSakit / $totalKelasRecords) * 100 : 0;
            $kelasPercentageIzin = ($totalKelasRecords > 0) ? ($kelasIzin / $totalKelasRecords) * 100 : 0;
            $kelasPercentageAlfa = ($totalKelasRecords > 0) ? ($kelasAlfa / $totalKelasRecords) * 100 : 0;
            $kelasPercentageTerlambat = ($totalKelasRecords > 0) ? ($kelasTerlambat / $totalKelasRecords) * 100 : 0;
            $kelasPercentageTAP = ($totalKelasRecords > 0) ? ($kelasTAP / $totalKelasRecords) * 100 : 0;

            $kelasData[] = [
                'kelas' => $kelas->tingkat . ' ' . $kelas->nomor_kelas,
                'total' => $totalKelasRecords,
                'countHadir' => $kelasHadir,
                'percentageHadir' => $kelasPercentageHadir,
                'countSakit' => $kelasSakit,
                'percentageSakit' => $kelasPercentageSakit,
                'countIzin' => $kelasIzin,
                'percentageIzin' => $kelasPercentageIzin,
                'countAlfa' => $kelasAlfa,
                'percentageAlfa' => $kelasPercentageAlfa,
                'countTerlambat' => $kelasTerlambat,
                'percentageTerlambat' => $kelasPercentageTerlambat,
                'countTAP' => $kelasTAP,
                'percentageTAP' => $kelasPercentageTAP,
            ];
        }

        return view('kesiswaan.kesiswaan', [
            'title' => 'Dashboard',
            'countHadir' => $countHadir,
            'countSakit' => $countSakit,
            'countIzin' => $countIzin,
            'countAlfa' => $countAlfa,
            'countTerlambat' => $countTerlambat,
            'countTAP' => $countTAP,
            'percentageHadir' => $percentageHadir,
            'percentageSakit' => $percentageSakit,
            'percentageIzin' => $percentageIzin,
            'percentageAlfa' => $percentageAlfa,
            'percentageTerlambat' => $percentageTerlambat,
            'percentageTAP' => $percentageTAP,
            'kelasData' => $kelasData,
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

    public function listsiswa()
    {
        return view('wali.listsiswa', [
            "title" => "Absen Siswa"
        ]);
    }
}
