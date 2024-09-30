<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Wali_Kelas;
use App\Models\Siswa;

class KesiswaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currentDay = now()->day;

        // Fetch all classes
        $kelasList = Kelas::with('siswa.absensi')->get();

        // Get total attendance data for all classes in the current month
        $totalAbsensi = Absensi::whereDay('date', $currentDay)
            ->get();

        // Calculate total counts and percentages for all classes
        $totalRecords = $totalAbsensi->count();

        $countHadir = $totalAbsensi->where('status', 'Hadir')->count();
        $countSakitIzin = ($totalAbsensi->where('status', 'Sakit')->count()) + ($totalAbsensi->where('status', 'Izin')->count());
        // $countIzin = $totalAbsensi->where('status', 'Izin')->count();
        $countAlfa = $totalAbsensi->where('status', 'Alfa')->count();
        $countTerlambat = $totalAbsensi->where('status', 'Terlambat')->count();
        $countTAP = $totalAbsensi->where('status', 'TAP')->count();

        $percentageHadir = ($totalRecords > 0) ? ($countHadir / $totalRecords) * 100 : 0;
        $percentageSakitIzin = ($totalRecords > 0) ? ($countSakitIzin / $totalRecords) * 100 : 0;
        // $percentageIzin = ($totalRecords > 0) ? ($countIzin / $totalRecords) * 100 : 0;
        $percentageAlfa = ($totalRecords > 0) ? ($countAlfa / $totalRecords) * 100 : 0;
        $percentageTerlambat = ($totalRecords > 0) ? ($countTerlambat / $totalRecords) * 100 : 0;
        $percentageTAP = ($totalRecords > 0) ? ($countTAP / $totalRecords) * 100 : 0;

        // Store attendance statistics for each class
        $kelasData = [];
        foreach ($kelasList as $kelas) {
            $siswaIds = $kelas->siswa->pluck('nis');
            $kelasAbsensi = Absensi::whereDay('date', $currentDay)
                ->whereIn('nis', $siswaIds)
                ->get();

            $totalKelasRecords = $kelasAbsensi->count();

            $kelasHadir = $kelasAbsensi->where('status', 'Hadir')->count();
            $kelasSakitIzin = ($kelasAbsensi->where('status', 'Sakit')->count()) + ($kelasAbsensi->where('status', 'Izin')->count());
            // $kelasIzin = $kelasAbsensi->where('status', 'Izin')->count();
            $kelasAlfa = $kelasAbsensi->where('status', 'Alfa')->count();
            $kelasTerlambat = $kelasAbsensi->where('status', 'Terlambat')->count();
            $kelasTAP = $kelasAbsensi->where('status', 'TAP')->count();

            // Calculate percentages for the class
            $kelasPercentageHadir = ($totalKelasRecords > 0) ? ($kelasHadir / $totalKelasRecords) * 100 : 0;
            $kelasPercentageSakitIzin = ($totalKelasRecords > 0) ? ($kelasSakitIzin / $totalKelasRecords) * 100 : 0;
            // $kelasPercentageIzin = ($totalKelasRecords > 0) ? ($kelasIzin / $totalKelasRecords) * 100 : 0;
            $kelasPercentageAlfa = ($totalKelasRecords > 0) ? ($kelasAlfa / $totalKelasRecords) * 100 : 0;
            $kelasPercentageTerlambat = ($totalKelasRecords > 0) ? ($kelasTerlambat / $totalKelasRecords) * 100 : 0;
            $kelasPercentageTAP = ($totalKelasRecords > 0) ? ($kelasTAP / $totalKelasRecords) * 100 : 0;

            $kelasData[] = [
                'kelas' => $kelas->tingkat . ' ' . $kelas->nomor_kelas,
                'total' => $totalKelasRecords,
                'countHadir' => $kelasHadir,
                'percentageHadir' => $kelasPercentageHadir,
                'countSakitIzin' => $kelasSakitIzin,
                'percentageSakitIzin' => $kelasPercentageSakitIzin,
                // 'countIzin' => $kelasIzin,
                // 'percentageIzin' => $kelasPercentageIzin,
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
            'countSakitIzin' => $countSakitIzin,
            // 'countIzin' => $countIzin,
            'countAlfa' => $countAlfa,
            'countTerlambat' => $countTerlambat,
            'countTAP' => $countTAP,
            'percentageHadir' => $percentageHadir,
            'percentageSakitIzin' => $percentageSakitIzin,
            // 'percentageIzin' => $percentageIzin,
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

    public function listsiswaA($id_kelas)
    {
        $kelas = Kelas::findOrFail($id_kelas);
        $siswa = $kelas->siswa;

        return view('kesiswaan.listsiswaA', [
            'title' => 'Daftar Siswa',
            'kelas' => $kelas,
            'siswa' => $siswa
        ]);
    }

    public function tambahsiswa(Request $request)
    {
        $datasiswa = Siswa::create([
            'nis' => $request->input('nis'),
            'id_kelas' => $request->input('id_kelas'),
            'nama' => $request->input('nama'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'nik' => $request->input('nik'),
            'nisn' => $request->input('nisn'),
        ]);
        return redirect()->back()->with('berhasil', 'Data Siswa Berhasil Ditambahkan');
    }

    public function editsiswa($nis)
    {
        $kelas = Kelas::with('jurusan')->get();
        $siswa = Siswa::findOrFail($nis);

        return view('kesiswaan.editsiswa', [
            'title' => 'Edit Siswa',
            'kelas' => $kelas,
            'siswa' => $siswa,
        ]);
    }

    public function updatesiswa(Request $request, $nis)
    {
        $siswa = Siswa::where('nis', $nis)
        ->update([
            'nis' => $request->input('nis'),
            'nama' => $request->input('nama'),
            'id_kelas' => $request->input('id_kelas'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'nik' => $request->input('nik'),
            'nisn' => $request->input('nisn'),
        ]);

        $siswa = Siswa::where('nis', $nis)->first();

        $id_kelas = $siswa->id_kelas;

        return redirect()->route('list-siswa-AD', ['id_kelas' => $id_kelas])->with('berhasil', 'Data Siswa Berhasil Diubah');
    }

    public function hapussiswa($nis)
    {
        $siswa = Siswa::where('nis', $nis)->delete();

        return redirect()->back()->with('berhasil', 'Data Siswa Berhasil Dihapus');

    }


    public function daftarwali()
    {
        $kelas = Kelas::with('jurusan', 'walikelas')->get();

        return view('kesiswaan.daftarwali', [
            'title' => 'Daftar Wali Kelas',
            'kelas' => $kelas
        ]);
    }

    public function laporan()
    {
        return view('kesiswaan.laporan',[
            "title" => "Laporan Absensi"
        ]);
    }

    public function listkelas()
    {
        $kelas = Kelas::with('jurusan', 'walikelas')->get();
        return view('kesiswaan.listkelas', [
            'title' => 'Daftar Kelas',
            'kelas' => $kelas
        ]);
    }

    public function listjurusan()
    {
        return view('kesiswaan.listjurusan',[
            "title" => "List Jurusan"
        ]);
    }
}
