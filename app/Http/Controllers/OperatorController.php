<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        dd($lok_sekolah);
        return view('operator.operator', compact('lok_sekolah'));
    }

    public function updatelokasisekolah()
    {
        $lokasi_sekolah = $request->lokasi_sekolah;
        $radius = $request->radius;

        $update = DB::table('koordinat__sekolahs')->where('id',1)->update([
            'lokasi_sekolah' => $lokasi_sekolah,
            'radius' => $radius
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
