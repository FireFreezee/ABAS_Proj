<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Wali_Siswa;
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
        // Get the logged-in user's Wali_Siswa
        $waliSiswa = Wali_Siswa::where('id_user', Auth::id())->first();

        // Fetch the students (siswa) related to the logged-in wali siswa
        $siswas = $waliSiswa->siswa()->with('kelas')->get(); // Load 'kelas' relationship

        foreach ($siswas as $siswa) {
            $nis = $siswa->nis; // Use the student's NIS to filter attendance

            // Initialize arrays to hold the attendance data
            $dataBulanIni = [];
            $dataBulanSebelumnya = [];

            // Get attendance data for the current month
            $dataBulanIni = Absensi::whereYear('date', date('Y'))
                ->where('nis', $nis)
                ->whereMonth('date', date('m'))
                ->select('status', DB::raw('count(*) as total'))
                ->groupBy('status')
                ->pluck('total', 'status')
                ->toArray();

            // Get attendance data for the previous month
            $dataBulanSebelumnya = Absensi::whereYear('date', date('Y'))
                ->where('nis', $nis)
                ->whereMonth('date', date('m', strtotime('first day of previous month')))
                ->select('status', DB::raw('count(*) as total'))
                ->groupBy('status')
                ->pluck('total', 'status')
                ->toArray();

            // Combine 'Sakit' and 'Izin' into one category for both months
            $dataBulanIni['Sakit/Izin'] = ($dataBulanIni['Sakit'] ?? 0) + ($dataBulanIni['Izin'] ?? 0);
            unset($dataBulanIni['Sakit'], $dataBulanIni['Izin']);

            $dataBulanSebelumnya['Sakit/Izin'] = ($dataBulanSebelumnya['Sakit'] ?? 0) + ($dataBulanSebelumnya['Izin'] ?? 0);
            unset($dataBulanSebelumnya['Sakit'], $dataBulanSebelumnya['Izin']);

            // Status that should be displayed
            $statuses = ['Hadir', 'Sakit/Izin', 'Alfa', 'Terlambat', 'TAP'];
            foreach ($statuses as $status) {
                if (!array_key_exists($status, $dataBulanIni)) {
                    $dataBulanIni[$status] = 0;
                }
                if (!array_key_exists($status, $dataBulanSebelumnya)) {
                    $dataBulanSebelumnya[$status] = 0;
                }
            }

            // Calculate totals and percentages for the current month
            $totalAbsenBulanIni = array_sum($dataBulanIni);
            $siswa->persentaseHadirBulanIni = $totalAbsenBulanIni > 0 ? round(($dataBulanIni['Hadir'] / $totalAbsenBulanIni) * 100) : 0;
            $siswa->persentaseSakitIzinBulanIni = $totalAbsenBulanIni > 0 ? round(($dataBulanIni['Sakit/Izin'] / $totalAbsenBulanIni) * 100) : 0;
            $siswa->persentaseAlfaBulanIni = $totalAbsenBulanIni > 0 ? round(($dataBulanIni['Alfa'] / $totalAbsenBulanIni) * 100) : 0;
            $siswa->persentaseTerlambatBulanIni = $totalAbsenBulanIni > 0 ? round(($dataBulanIni['Terlambat'] / $totalAbsenBulanIni) * 100) : 0;
            $siswa->persentaseTAPBulanIni = $totalAbsenBulanIni > 0 ? round(($dataBulanIni['TAP'] / $totalAbsenBulanIni) * 100) : 0;

            // Calculate totals and percentages for the previous month
            $totalAbsenBulanSebelumnya = array_sum($dataBulanSebelumnya);
            $siswa->persentaseHadirBulanSebelumnya = $totalAbsenBulanSebelumnya > 0 ? round(($dataBulanSebelumnya['Hadir'] / $totalAbsenBulanSebelumnya) * 100) : 0;
            $siswa->persentaseSakitIzinBulanSebelumnya = $totalAbsenBulanSebelumnya > 0 ? round(($dataBulanSebelumnya['Sakit/Izin'] / $totalAbsenBulanSebelumnya) * 100) : 0;
            $siswa->persentaseAlfaBulanSebelumnya = $totalAbsenBulanSebelumnya > 0 ? round(($dataBulanSebelumnya['Alfa'] / $totalAbsenBulanSebelumnya) * 100) : 0;
            $siswa->persentaseTerlambatBulanSebelumnya = $totalAbsenBulanSebelumnya > 0 ? round(($dataBulanSebelumnya['Terlambat'] / $totalAbsenBulanSebelumnya) * 100) : 0;
            $siswa->persentaseTAPBulanSebelumnya = $totalAbsenBulanSebelumnya > 0 ? round(($dataBulanSebelumnya['TAP'] / $totalAbsenBulanSebelumnya) * 100) : 0;

            // Attach the data to the student object
            $siswa->dataBulanIni = $dataBulanIni;
            $siswa->dataBulanSebelumnya = $dataBulanSebelumnya;
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
