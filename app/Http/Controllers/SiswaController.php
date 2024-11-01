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
        $siswa = Siswa::with('user')->where('id_user', auth::user()->id)->first();
        $hariini = date("Y-m-d");
        $cek = Absensi::where('date', $hariini)->where('nis', $siswa->nis)->first();
        $late2 = Absensi::where('nis', $siswa->nis)
            ->whereMonth('date', date('m', strtotime('first day of previous month')))
            ->sum('menit_keterlambatan');
        $late = Absensi::where('nis', $siswa->nis)
            ->whereMonth('date', date('m'))
            ->sum('menit_keterlambatan');

        // Check today's attendance status
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

        // Get attendance data for the current month
        $dataBulanIni = Absensi::whereYear('date', date('Y'))
            ->where('nis', $siswa->nis)
            ->whereMonth('date', date('m'))
            ->select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        // Get attendance data for the previous month
        $dataBulanSebelumnya = Absensi::whereYear('date', date('Y'))
            ->where('nis', $siswa->nis)
            ->whereMonth('date', date('m', strtotime('first day of previous month')))
            ->select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        // Combine 'Sakit' and 'Izin' into one category
        $dataBulanIni['Sakit/Izin'] = ($dataBulanIni['Sakit'] ?? 0) + ($dataBulanIni['Izin'] ?? 0);
        unset($dataBulanIni['Sakit'], $dataBulanIni['Izin']);

        $dataBulanSebelumnya['Sakit/Izin'] = ($dataBulanSebelumnya['Sakit'] ?? 0) + ($dataBulanSebelumnya['Izin'] ?? 0);
        unset($dataBulanSebelumnya['Sakit'], $dataBulanSebelumnya['Izin']);

        // Combine 'Hadir', 'Terlambat', and 'TAP' into 'Hadir Total'
        $dataBulanIni['Hadir/Terlambat/TAP'] = ($dataBulanIni['Hadir'] ?? 0) + ($dataBulanIni['Terlambat'] ?? 0) + ($dataBulanIni['TAP'] ?? 0);
        unset($dataBulanIni['Hadir'], $dataBulanIni['Terlambat'], $dataBulanIni['TAP']);

        $dataBulanSebelumnya['Hadir/Terlambat/TAP'] = ($dataBulanSebelumnya['Hadir'] ?? 0) + ($dataBulanSebelumnya['Terlambat'] ?? 0) + ($dataBulanSebelumnya['TAP'] ?? 0);
        unset($dataBulanSebelumnya['Hadir'], $dataBulanSebelumnya['Terlambat'], $dataBulanSebelumnya['TAP']);

        // Initialize all statuses
        $statuses = ['Hadir/Terlambat/TAP', 'Sakit/Izin', 'Alfa'];
        foreach ($statuses as $status) {
            $dataBulanIni[$status] = $dataBulanIni[$status] ?? 0;
            $dataBulanSebelumnya[$status] = $dataBulanSebelumnya[$status] ?? 0;
        }

        // Calculate total attendance for percentages
        $totalAttendanceCurrentMonth = array_sum($dataBulanIni);
        $totalAttendancePreviousMonth = array_sum($dataBulanSebelumnya);

        // Prepare an array for the current month percentages
        $currentMonthPercentages = [];
        foreach ($dataBulanIni as $status => $count) {
            if ($totalAttendanceCurrentMonth > 0) {
                $currentMonthPercentages[$status] = round(($count / $totalAttendanceCurrentMonth) * 100);
            } else {
                $currentMonthPercentages[$status] = 0;
            }
        }

        // Prepare an array for the previous month percentages
        $previousMonthPercentages = [];
        foreach ($dataBulanSebelumnya as $status => $count) {
            if ($totalAttendancePreviousMonth > 0) {
                $previousMonthPercentages[$status] = round(($count / $totalAttendancePreviousMonth) * 100);
            } else {
                $previousMonthPercentages[$status] = 0;
            }
        }

        // Get attendance records for the current week
        $startOfWeek = date('Y-m-d', strtotime('monday this week'));
        $endOfWeek = date('Y-m-d', strtotime('friday this week'));

        $riwayatmingguini = Absensi::whereBetween('date', [$startOfWeek, $endOfWeek])
            ->where('nis', $siswa->nis)
            ->orderBy('date', 'asc')
            ->get();

        $jam = date("H:i:s");
        $waktu = DB::table('waktu__absens')->where('id_waktu_absen', 1)->first();
        $lok_sekolah = DB::table('koordinat__sekolahs')->where('id_koordinat_sekolah', 1)->first();

        return view('Siswa.siswa', [
            'waktu' => $waktu,
            'cek' => $cek,
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
            'persentaseHadirBulanIni' => $currentMonthPercentages['Hadir/Terlambat/TAP'] ?? 0,
            'persentaseHadirBulanSebelumnya' => $previousMonthPercentages['Hadir/Terlambat/TAP'] ?? 0,
            'riwayatmingguini' => $riwayatmingguini,
            'persentaseSakitIzinBulanIni' => $currentMonthPercentages['Sakit/Izin'] ?? 0,
            'persentaseAlfaBulanIni' => $currentMonthPercentages['Alfa'] ?? 0,
            'persentaseSakitIzinBulanSebelumnya' => $previousMonthPercentages['Sakit/Izin'] ?? 0,
            'persentaseAlfaBulanSebelumnya' => $previousMonthPercentages['Alfa'] ?? 0,
        ]);
    }





    public function Absen()
    {
        $user = Auth::user();
        $nis = $user->siswa->nis;
        $hariini = date("Y-m-d");
        $cek = DB::table('absensis')->where('date', $hariini)->where('nis', $nis)->first();
        $lok_sekolah = DB::table('koordinat__sekolahs')->where('id_koordinat_sekolah', 1)->first();
        $waktu = DB::table('waktu__absens')->where('id_waktu_absen', 1)->first();
        return view('Siswa.absen', compact('lok_sekolah', 'waktu', 'cek'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $siswa = siswa::where('id_user', $user->id)->first();
        $status = 'Alfa';
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
        $formatMasuk = $siswa->nis . "-" . $date . "-" . "masuk";
        $formatPulang = $siswa->nis . "-" . $date . "-" . "pulang";
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

        $cek = Absensi::where('date', $date)->where('nis', $siswa->nis)->first();
        // if ($radius > $radiussekolah) {
        //     echo "error|Anda Berada Diluar Radius, Jarak Anda " . $radius . " meter dari Sekolah|";
        if ($faceConfidence < 0.90) { // Confidence threshold
            echo "error|Wajah Tidak Terdeteksi dengan Kepastian 90%|";
        } else {
            if ($status == "Hadir" || $status == "Terlambat") {
                $fileName = $formatPulang . ".png";
                $file = $folderPath . $fileName;
                $data_pulang = [
                    'photo_out' => $fileName,
                    'jam_pulang' => $jam,
                    'titik_koordinat_pulang' => $lokasiSiswa,
                ];
                $update = DB::table('absensis')->where('date', $date)->where('nis', $siswa->nis)->update($data_pulang);
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
                    'nis' => $siswa->nis,
                    'status' => $status,
                    'photo_in' => $fileName,
                    'date' => $date,
                    'jam_masuk' => $jam,
                    'titik_koordinat_masuk' => $lokasiSiswa,
                    'menit_keterlambatan' => $menit_terlambat,
                ];

                $simpan = DB::table('absensis')->where('date', $date)->where('nis', $siswa->nis)->update($data);

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
        // Validate the request data
        $request->validate([
            'keterangan' => 'required|string|max:255',
            'status' => 'required|string',
        ]);

        $user = Auth::user();
        $nis = $user->siswa->nis;
        $status = $request->status;
        $date = date("Y-m-d");
        $jam = date("H:i:s");
        $lokasiSiswa = $request->lokasi;

        $photoPath = null; // Initialize photoPath variable

        // Check if photo_in is from webcam (base64)
        if (strpos($request->photo_in, 'data:image/jpeg;base64,') === 0) {
            // Process the base64 image
            $fileData = explode(',', $request->photo_in);
            $image = base64_decode($fileData[1]);
            $fileName = $nis . "-" . $date . "-" . uniqid() . ".jpeg";

            // Use Storage to save the image in the absensi directory
            Storage::disk('public')->put('uploads/absensi/' . $fileName, $image);
            $photoPath = $fileName;
        } else {
            // If not from webcam, use the uploaded file directly
            $photoPath = $request->photo_in;
        }

        // Prepare data for database insertion
        $data = [
            'nis' => $nis,
            'status' => $status,
            'photo_in' => $photoPath,
            'keterangan' => $request->keterangan,
            'date' => $date,
            'jam_masuk' => $jam,
            'titik_koordinat_masuk' => $lokasiSiswa,
        ];

        // Save to database and handle success/failure
        if (DB::table('absensis')->where('date', $date)->where('nis', $nis)->update($data)) {
            return redirect()->route('siswa-dashboard')->with('success', 'Absensi berhasil disimpan!');
        } else {
            // If saving to the database fails, delete the uploaded file if it exists
            if ($photoPath && Storage::disk('public')->exists('uploads/absensi/' . $photoPath)) {
                Storage::disk('public')->delete('uploads/absensi/' . $photoPath);
            }
            return redirect()->back()->with('failed', 'Absensi gagal disimpan!');
        }
    }

    public function fileUpload(Request $request)
    {
        // Keep this method if you still want to handle regular file uploads
        $request->validate([
            'photo_in' => 'required|image|mimes:jpeg,png,jpg,pdf|max:2048',
        ]);

        if ($request->hasFile('photo_in')) {
            $user = Auth::user();
            $nis = $user->siswa->nis;
            $date = date("Y-m-d");
            $file = $request->file('photo_in');
            $fileName = $nis . "-" . $date . "." . uniqid(true) . '-' . $file->getClientOriginalName();
            $folderPath = "public/uploads/absensi/";
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

        // Apply date range filtering and weekday filtering
        if ($startDate && $endDate) {
            $query->whereBetween('date', [$startDate, $endDate])
                ->whereNotIn(DB::raw('DAYOFWEEK(date)'), [1, 7]); // 1 = Sunday, 7 = Saturday
        }

        // Get the filtered data for calculating statistics
        $filteredData = $query->get();

        // Aggregate data by status
        $statusCounts = $filteredData->groupBy('status')->map->count();
        $totalCount = $filteredData->count();

        // Combine "Hadir", "Terlambat", and "TAP" into one category
        $combinedStatus = [
            'Hadir/Terlambat/TAP' => ($statusCounts->get('Hadir', 0) +
                $statusCounts->get('Terlambat', 0) +
                $statusCounts->get('TAP', 0))
        ];

        // Add other statuses to the combined array
        $combinedStatus = array_merge($combinedStatus, $statusCounts->except(['Hadir', 'Terlambat', 'TAP'])->toArray());

        // Update the statusCounts to include combined status
        $statusCounts = collect($combinedStatus);

        // Calculate percentage for each status based on filtered data
        $statusPercentages = [];
        foreach ($statusCounts as $status => $count) {
            // Calculate the percentage based on the actual total count of filtered data
            $statusPercentages[$status] = $totalCount > 0 ? ($count / $totalCount) * 100 : 0;
        }

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
            return redirect()->route('siswa-dashboard')->with('success', "Data Berhasil di Update");
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
