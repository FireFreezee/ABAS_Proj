<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Absensi;
use App\Models\Siswa;
use App\Models\Koordinat_Sekolah;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $nis = $user->siswa->nis;
        $hariini = date("Y-m-d");
        $cek = DB::table('absensis')->where('date', $hariini)->where('nis', $nis)->first();

        if ($cek) {
            $statusAbsen = $cek->jam_masuk ? 'Hadir' : 'Belum Absen';

            if ($cek->jam_masuk && ($cek->photo_out || $cek->titik_koordinat_pulang)) {
                $statusAbsen = 'Sudah Pulang';
            } elseif ($cek->jam_masuk) {
                $statusAbsen = $cek->status;
            }
        } else {
            $statusAbsen = 'Belum Absen';
        }

        // $batas_absen_pulang = '23:10';
        // $jam_absen = '22:50';
        $jam = date("H:i:s");
        $waktu = DB::table('waktu__absens')->where('id_waktu_absen', 1)->first();
        $lok_sekolah = DB::table('koordinat__sekolahs')->where('id_koordinat_sekolah', 1)->first();
        $presensi_hari_ini = DB::table('absensis')->where('nis', $nis)->where('jam_masuk');
        $siswa = Siswa::with('user')->get();
        return view('Siswa.siswa', [
            'waktu' => $waktu,
            'cek' => $cek ? 1 : 0,
            'statusAbsen' => $statusAbsen,
            'lok_sekolah' => $lok_sekolah,
            'siswa' => $siswa,
            'jam' => $jam,
            'jam_absen' => $waktu->jam_absen,
            'batas_absen_pulang' => $waktu->batas_absen_pulang
        ]);
    }

    public function Absen()
    {
        $user = Auth::user();
        $nis = $user->siswa->nis;
        $hariini = date("Y-m-d");
        $cek = DB::table('absensis')->where('date', $hariini)->where('nis', $nis)->count();
        $lok_sekolah = DB::table('koordinat__sekolahs')->where('id_koordinat_sekolah', 1)->first();
        $waktu = DB::table('waktu__absens')->where('id_waktu_absen', 1)->first();
        return view('Siswa.absen', compact('lok_sekolah', 'waktu', 'cek'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $nis = $user->siswa->nis;
        $status = 'Hadir';
        $date = date("Y-m-d");
        $jam = date("H:i:s");

        $lokasiSiswa = $request->lokasi;
        $lokasiuser = explode(",", $lokasiSiswa);
        $latitudeuser = $lokasiuser[0];
        $longitudeuser = $lokasiuser[1];
        $lok_sekolah = Koordinat_Sekolah::first();
        $radiussekolah = $lok_sekolah->radius;
        $lok = explode(",", $lok_sekolah->lokasi_sekolah);
        $latitudesekolah = $lok[0];
        $longitudesekolah = $lok[1];
        $jarak = $this->distance($latitudesekolah, $longitudesekolah, $latitudeuser, $longitudeuser);
        $radius = round($jarak["meters"]);

        $image = $request->image;
        $folderPath = "public/uploads/absensi/";
        $formatName = $nis . "-" . $date;
        $image_parts = explode(";base64", $image);
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = $formatName . ".png";
        $file = $folderPath . $fileName;

        // Get face confidence
        $faceConfidence = $request->faceConfidence;

        $batasMasuk = DB::table('waktu__absens')->value('batas_absen_masuk');

        // Determine status

        if ($jam > $batasMasuk) {
            $status = 'Terlambat';
        } else {
            $status = 'Hadir';
        }

        $cek = DB::table('absensis')->where('date', $date)->where('nis', $nis)->count();
        if ($radius > $radiussekolah) {
            echo "error|Anda Berada Diluar Radius, Jarak Anda " . $radius . " meter dari Sekolah|";
        } elseif ($faceConfidence < 0.90) { // Confidence threshold
            echo "error|Wajah Tidak Terdeteksi dengan Kepastian 90%|";
        } else {
            if ($cek > 0) {
                $data_pulang = [
                    'photo_out' => $fileName,
                    'jam_pulang' => $jam,
                    'titik_koordinat_pulang' => $lokasiSiswa,
                ];
                $update = DB::table('absensis')->where('date', $date)->where('nis', $nis)->update($data_pulang);
                if ($update) {
                    echo "success|Terimakasih, Hati-Hati Dijalan!|out";
                    Storage::put($file, $image_base64);
                } else {
                    echo "error|Absen Gagal|out";
                }
            } else {
                $data = [
                    'nis' => $nis,
                    'status' => $status,
                    'photo_in' => $fileName,
                    'date' => $date,
                    'jam_masuk' => $jam,
                    'titik_koordinat_masuk' => $lokasiSiswa,
                ];

                $simpan = DB::table('absensis')->insert($data);

                if ($simpan) {
                    echo "success|Terimakasih, Selamat Belajar!|in";
                    Storage::put($file, $image_base64);
                } else {
                    echo "error|Absen Gagal|in";
                }
            }
        }
    }

    function distance($lat1, $lon1, $lat2, $lon2)
    {
        $theta = $lon1 - $lon2;
        $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
        $miles = acos($miles);
        $miles = rad2deg($miles);
        $miles = $miles * 60 * 1.1515;
        $feet = $miles * 5200;
        $yards = $feet / 3;
        $kilometers = $miles * 1.609344;
        $meters = $kilometers * 1000;
        return compact('meters');
    }

    public function izin()
    {
        return view('Siswa.izin');
    }

    public function izin_store(Request $request)
    {
        $request->validate([
            'photo_in' => 'required|mimes:jpeg,png,jpg,pdf|max:10000',
            'keterangan' => 'required|string|max:255',
            'status' => 'required|string',
        ]);

        if ($request->hasFile('photo_in')) {
            $user = Auth::user();
            $nis = $user->siswa->nis;
            $status = $request->status;
            $date = date("Y-m-d");
            $jam = date("H:i:s");

            $lokasiSiswa = $request->lokasi;
            $foto = $request->file('photo_in');
            
            $extension = $foto->getClientOriginalExtension();
            $folderPath = "public/uploads/absensi/";
            $fileName = $nis . "-" . $date . "-" . $status . "." . $extension;
            $file = $folderPath . $fileName;
            

            $data = [
                'nis' => $nis,
                'status' => $status,
                'photo_in' => $fileName,
                'keterangan' => $request->keterangan,
                'date' => $date,
                'jam_masuk' => $jam,
                'titik_koordinat_masuk' => $lokasiSiswa,
            ];

            $simpan = DB::table('absensis')->insert($data);
            if ($simpan) {
                Storage::put($file, file_get_contents($foto));
                return redirect()->route('siswa-dashboard')->with('success', 'Absensi berhasil disimpan!');
            } else {
                return redirect()->route('siswa-izin')->with('error', 'Gagal');
            }
        }
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
