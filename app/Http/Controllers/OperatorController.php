<?php

namespace App\Http\Controllers;

use App\Models\Wali_Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class OperatorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Operator.operator',[
            "title" => "Dashboard"
        ]);
    }

    public function dataWali()
    {
        $wali_kelas = Wali_Kelas::with('user')->get();
        return view('Operator.crudWalikelas', compact('wali_kelas'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function lokasisekolah()
    {
        $lok_sekolah = DB::table('koordinat__sekolahs')->where('id_koordinat_sekolah',1)->first();
        $waktu = DB::table('waktu__absens')->where('id_waktu_absen',1)->first();
        // $lok = explode(",", $lok_sekolah->lokasi_sekolah);
        // $latitudesekolah = $lok[0];
        // $longitudesekolah = $lok[1];
        return view('operator.operator', compact('lok_sekolah', 'waktu'));
    }

    public function updatelokasisekolah(Request $request)
    {
        $lokasi_sekolah = $request->input('lokasi_sekolah');
        $radius = $request->input('radius');

        $update = DB::table('koordinat__sekolahs')
                    ->where('id_koordinat_sekolah', 1)
                    ->update([
                        'lokasi_sekolah' => $lokasi_sekolah,
                        'radius' => $radius
                    ]);

        if ($update) {
            return Redirect::back()->with(['success'=>'Data Berhasil Diupdate']);
        }else {
            return Redirect::back()->with(['warning'=>'Data Gagal Diupdate']);
        }
    }

    public function updatewaktu(Request $request)
    {
        $jam_absen = $request->input('jam_absen');
        $jam_pulang = $request->input('jam_pulang');
        $batas_absen_masuk = $request->input('batas_absen_masuk');
        $batas_absen_pulang = $request->input('batas_absen_pulang');

        $update = DB::table('waktu__absens')
                    ->where('id_waktu_absen', 1)
                    ->update([
                        'jam_absen' => $jam_absen,
                        'jam_pulang' => $jam_pulang,
                        'batas_absen_masuk' => $batas_absen_masuk,
                        'batas_absen_pulang' => $batas_absen_pulang
                    ]);

        if ($update) {
            return Redirect::back()->with(['success'=>'Data Berhasil Diupdate']);
        }else {
            return Redirect::back()->with(['warning'=>'Data Gagal Diupdate']);
        }
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
