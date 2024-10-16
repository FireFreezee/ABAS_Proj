<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Absensi;
use App\Models\Siswa;
use App\Models\Koordinat_Sekolah;
use App\Models\User;
use App\Models\Waktu_Absen;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

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
        $late2 = Absensi::where('nis', $nis)->whereMonth('date', date('m', strtotime('first day of previous month')))->sum('menit_keterlambatan');
        $late = Absensi::where('nis', $nis)->whereMonth('date', date('m'))->sum('menit_keterlambatan');


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

        $dataBulanIni = Absensi::whereYear('date', date('Y'))
            ->where('nis', $nis)
            ->whereMonth('date', date('m'))
            ->select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        $dataBulanSebelumnya = Absensi::whereYear('date', date('Y'))
            ->where('nis', $nis)
            ->whereMonth('date', date('m', strtotime('first day of previous month')))
            ->select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();


        // Gabungkan 'Sakit' dan 'Izin' menjadi satu kategori
        $dataBulanIni['Sakit/Izin'] = ($dataBulanIni['Sakit'] ?? 0) + ($dataBulanIni['Izin'] ?? 0);
        unset($dataBulanIni['Sakit'], $dataBulanIni['Izin']);

        $dataBulanSebelumnya['Sakit/Izin'] = ($dataBulanSebelumnya['Sakit'] ?? 0) + ($dataBulanSebelumnya['Izin'] ?? 0);
        unset($dataBulanSebelumnya['Sakit'], $dataBulanSebelumnya['Izin']);

        // Status yang tersisa
        $statuses = ['Hadir', 'Sakit/Izin', 'Alfa', 'Terlambat', 'TAP'];
        foreach ($statuses as $status) {
            if (!array_key_exists($status, $dataBulanIni)) {
                $dataBulanIni[$status] = 0;
            }
            if (!array_key_exists($status, $dataBulanSebelumnya)) {
                $dataBulanSebelumnya[$status] = 0;
            }
        }

        $totalAbsenBulanIni = array_sum($dataBulanIni);
        $persentaseHadirBulanIni = $totalAbsenBulanIni > 0 ? round(($dataBulanIni['Hadir'] / $totalAbsenBulanIni) * 100) : 0;
        $persentaseSakitIzinBulanIni = $totalAbsenBulanIni > 0 ? round(($dataBulanIni['Sakit/Izin'] / $totalAbsenBulanIni) * 100) : 0;
        $persentaseAlfaBulanIni = $totalAbsenBulanIni > 0 ? round(($dataBulanIni['Alfa'] / $totalAbsenBulanIni) * 100) : 0;
        $persentaseTerlambatBulanIni = $totalAbsenBulanIni > 0 ? round(($dataBulanIni['Terlambat'] / $totalAbsenBulanIni) * 100) : 0;
        $persentaseTAPBulanIni = $totalAbsenBulanIni > 0 ? round(($dataBulanIni['TAP'] / $totalAbsenBulanIni) * 100) : 0;


        // Menghitung persentase hadir bulan sebelumnya
        $totalAbsenBulanSebelumnya = array_sum($dataBulanSebelumnya);
        $persentaseHadirBulanSebelumnya = $totalAbsenBulanSebelumnya > 0 ? round(($dataBulanSebelumnya['Hadir'] / $totalAbsenBulanSebelumnya) * 100) : 0;
        $persentaseSakitIzinBulanSebelumnya = $totalAbsenBulanSebelumnya > 0 ? round(($dataBulanSebelumnya['Sakit/Izin'] / $totalAbsenBulanSebelumnya) * 100) : 0;
        $persentaseAlfaBulanSebelumnya = $totalAbsenBulanSebelumnya > 0 ? round(($dataBulanSebelumnya['Alfa'] / $totalAbsenBulanSebelumnya) * 100) : 0;
        $persentaseTerlambatBulanSebelumnya = $totalAbsenBulanSebelumnya > 0 ? round(($dataBulanSebelumnya['Terlambat'] / $totalAbsenBulanSebelumnya) * 100) : 0;
        $persentaseTAPBulanSebelumnya = $totalAbsenBulanSebelumnya > 0 ? round(($dataBulanSebelumnya['TAP'] / $totalAbsenBulanSebelumnya) * 100) : 0;

        $startOfWeek = date('Y-m-d', strtotime('monday this week'));
        $endOfWeek = date('Y-m-d', strtotime('sunday this week'));

        $riwayatmingguini = Absensi::whereBetween('date', [$startOfWeek, $endOfWeek])
            ->where('nis', $nis) // Sesuaikan dengan kolom NIS siswa
            ->orderBy('date', 'asc')
            ->get();

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
            'batas_absen_pulang' => $waktu->batas_absen_pulang,
            'dataBulanIni' => $dataBulanIni,
            'dataBulanSebelumnya' => $dataBulanSebelumnya,
            'late' => $late,
            'late2' => $late2,
            'persentaseHadirBulanIni' => $persentaseHadirBulanIni,
            'persentaseHadirBulanSebelumnya' => $persentaseHadirBulanSebelumnya,
            'riwayatmingguini' => $riwayatmingguini,
            'persentaseSakitIzinBulanIni' => $persentaseSakitIzinBulanIni,
            'persentaseAlfaBulanIni' => $persentaseAlfaBulanIni,
            'persentaseTerlambatBulanIni' => $persentaseTerlambatBulanIni,
            'persentaseTAPBulanIni' => $persentaseTAPBulanIni,
            'persentaseSakitIzinBulanSebelumnya' => $persentaseSakitIzinBulanSebelumnya,
            'persentaseAlfaBulanSebelumnya' => $persentaseAlfaBulanSebelumnya,
            'persentaseTerlambatBulanSebelumnya' => $persentaseTerlambatBulanSebelumnya,
            'persentaseTAPBulanSebelumnya' => $persentaseTAPBulanSebelumnya
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
        $folderPath = "uploads/absensi/";
        $formatMasuk = $nis . "-" . $date . "-" . "masuk";
        $formatPulang = $nis . "-" . $date . "-" . "pulang";
        $image_parts = explode(";base64", $image);
        $image_base64 = base64_decode($image_parts[1]);

        // Get face confidence
        $faceConfidence = $request->faceConfidence;

        // $batasMasuk = DB::table('waktu__absens')->value('batas_absen_masuk');

        $validasiAbsen = Waktu_Absen::first();

        $batas_absen_masuk = strtotime($validasiAbsen->batas_absen_masuk);
        $jam_absen = strtotime($jam);

        if ($jam_absen > $batas_absen_masuk) {
            $selisihDetik = $jam_absen - $batas_absen_masuk;
            $menit_terlambat = abs($selisihDetik) / 60;
            $status = 'terlambat';
        } else {
            $status = 'hadir';
            $menit_terlambat = null;
        }

        $cek = DB::table('absensis')->where('date', $date)->where('nis', $nis)->count();
        if ($radius > $radiussekolah) {
            echo "error|Anda Berada Diluar Radius, Jarak Anda " . $radius . " meter dari Sekolah|";
        } elseif ($faceConfidence < 0.90) { // Confidence threshold
            echo "error|Wajah Tidak Terdeteksi dengan Kepastian 90%|";
        } else {
            if ($cek > 0) {
                $fileName = $formatPulang . ".png";
                $file = $folderPath . $fileName;
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
                $fileName = $formatMasuk . ".png";
                $file = $folderPath . $fileName;
                $data = [
                    'nis' => $nis,
                    'status' => $status,
                    'photo_in' => $fileName,
                    'date' => $date,
                    'jam_masuk' => $jam,
                    'titik_koordinat_masuk' => $lokasiSiswa,
                    'menit_keterlambatan' => $menit_terlambat,
                ];

                $simpan = DB::table('absensis')->update($data);

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
            'photo_in' => 'required|string',
            'keterangan' => 'required|string|max:255',
            'status' => 'required|string',
        ]);

            $user = Auth::user();
            $nis = $user->siswa->nis;
            $status = $request->status;
            $date = date("Y-m-d");
            $jam = date("H:i:s");

            $lokasiSiswa = $request->lokasi;

            // $file = $request->file('photo_in');
            // $extension = $file->getClientOriginalExtension();
            // $folderPath = "public/uploads/absensi/";
            // $fileName = $nis . "-" . $date . "-" . $status . "." . $extension;

            // Insert data into the database
            $data = [
                'nis' => $nis,
                'status' => $status,
                'photo_in' => $request->photo_in,
                'keterangan' => $request->keterangan,
                'date' => $date,
                'jam_masuk' => $jam,
                'titik_koordinat_masuk' => $lokasiSiswa,
            ];

            if ($data) {
                DB::table('absensis')->insert($data);
                return redirect()->route('siswa-dashboard')->with('success', 'Absensi berhasil disimpan!');
            }
            else {
                return redirect()->back()->with('failed', 'Absensi gagal disimpan!');
            }


    }

    public function fileUpload(Request $request)
    {
        $request->validate([
            'photo_in' => 'required|image|mimes:jpeg,png,jpg,pdf|max:2048',
        ]);

        if ($request->hasFile('photo_in')) {
            $user = Auth::user();
            $nis = $user->siswa->nis;
            // $status = $request->status;

            $date = date("Y-m-d");
            $file = $request->file('photo_in');
            $fileName = $nis . "-" . $date . "." . uniqid(true) . '-' . $file->getClientOriginalName();
            $folderPath = "uploads/absensi/";
            $file->storeAs($folderPath, $fileName);

            return $fileName;
        }

        return '';
    }

    public function laporan(Request $request)
    {
        // Get the start and end dates from the request
        $startDate = $request->input('start');
        $endDate = $request->input('end');

        // Set default to the current month if no dates are provided
        if (!$startDate || !$endDate) {
            $startDate = Carbon::now()->startOfMonth()->toDateString();
            $endDate = Carbon::now()->endOfMonth()->toDateString();
        }

        // Get the authenticated user
        $user = Auth::user();

        // Ensure the user has a related 'siswa' record
        if (!$user->siswa) {
            return redirect()->back()->with('error', 'No student data found for this user.');
        }

        // Get the 'nis' from the 'siswa' record
        $nis = $user->siswa->nis;

        // Initialize the query
        $query = Absensi::where('nis', $nis);

        // Apply date range filtering if dates are provided
        if ($startDate && $endDate) {
            $query->whereBetween('date', [$startDate, $endDate]);
        }

        // Get the filtered data for calculating statistics
        $filteredData = $query->get();

        // Aggregate data by status
        $statusCounts = $filteredData->groupBy('status')->map->count();
        $totalCount = $filteredData->count();

        // Calculate percentage for each status
        $statusPercentages = $statusCounts->map(function ($count) use ($totalCount) {
            return $totalCount > 0 ? ($count / $totalCount) * 100 : 0;
        });

        // Paginate the results with a limit of 10 items per page
        $absensiPaginated = $query->paginate(10)->appends($request->only(['start', 'end']));

        // Pass the attendance data, status counts, and filter dates to the view
        return view('siswa.laporan', compact('absensiPaginated', 'statusCounts', 'statusPercentages', 'startDate', 'endDate'));
    }

    public function profile()
    {
        return view("Siswa.profile");
    }

    public function editprofil(Request $r)
    {
        $f = false;
        $p = false;

        //password
        $count = strlen($r->password);
        if ($count > 0) {
            $p = User::where('id', $r->id)->update([
                'password' => password_hash($r->password, PASSWORD_DEFAULT)
            ]);
        }
        if ($r->password != $r->kPassword) {
            return redirect()->back()->with('failed', 'Password Berbeda');
        }

        //foto
        $f = User::where('id', $r->id)->update([
            'foto' => $r->profile,
        ]);


        // email
        $u = User::where('id', $r->id)->update([
            'email' => $r->email,
        ]);

        //redirecting
        if ($u || $f || $p) {
            return redirect()->back()->with('success', "Data Berhasil di Update");
        } else {
            return redirect()->back()->with('failed', "Data Gagal di Update");
        }
    }

    public function photo_profile(Request $request)
    {
        $request->validate([
            'profile' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('profile')) {

            // $status = $request->status;

            $file = $request->file('profile');
            $fileName = uniqid(true) . '-' . $file->getClientOriginalName();
            $folderPath = "uploads/profile/";
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
