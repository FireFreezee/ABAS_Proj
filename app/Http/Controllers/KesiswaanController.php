<?php

namespace App\Http\Controllers;

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
        return view('kesiswaan.kesiswaan', [
            "title" => "Dashboard",
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
