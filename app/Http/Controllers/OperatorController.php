<?php

namespace App\Http\Controllers;

use App\Imports\KelasImport;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
use App\Models\Wali_Kelas;
use App\Imports\WaliImport;
use App\Models\Wali_Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;

class OperatorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Operator.operator', [
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
        $lok_sekolah = DB::table('koordinat__sekolahs')->where('id_koordinat_sekolah', 1)->first();
        $waktu = DB::table('waktu__absens')->where('id_waktu_absen', 1)->first();
        // $lok = explode(",", $lok_sekolah->lokasi_sekolah);
        // $latitudesekolah = $lok[0];
        // $longitudesekolah = $lok[1];
        return view('Operator.operator', compact('lok_sekolah', 'waktu'));
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
            return Redirect::back()->with(['success' => 'Data Berhasil Diupdate']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Diupdate']);
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
            return Redirect::back()->with(['success' => 'Data Berhasil Diupdate']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Diupdate']);
        }
    }

    public function dataWali()
    {
        $jenisKelamin = ['laki laki', 'perempuan'];
        $wali_kelas = Wali_Kelas::with(['user', 'kelas', 'jurusan'])
            ->whereHas('user', function ($query) {
                $query->where('role', 'wali');
            })
            ->get();
        return view('Operator.crudWalikelas', compact('wali_kelas', 'jenisKelamin'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (strlen($request->password) > 0) {
            $user = User::create([
                'nama' => $request->name,
                'email' => $request->email,
                'password' => password_hash($request->password, PASSWORD_DEFAULT),
                'role' => 'wali'
            ]);

            Wali_Kelas::insert([
                'nuptk' => $request->nuptk,
                'id_user' => $user->id,
                'jenis_kelamin' => $request->jenis_kelamin,
                'nip' => $request->nip,
            ]);
        } else {
            $user = User::create([
                'nama' => $request->name,
                'email' => $request->email,
                'role' => 'wali'
            ]);

            Wali_Kelas::insert([
                'nuptk' => $request->nuptk,
                'id_user' => $user->id,
                'jenis_kelamin' => $request->jenis_kelamin,
                'nip' => $request->nip,
            ]);
        }

        return redirect()->route('data-wali')->with('success', 'Wali Kelas berhasil ditambahkan!');
    }

    public function editwali(Request $r)
    {
        //DB wali
        DB::table('wali__kelas')->where('id_user', $r->id)->update([
            'nuptk' => $r->nuptk,
            'jenis_kelamin' => $r->jenis_kelamin,
            'nip' => $r->nip,
        ]);


        //DB user
        DB::table('users')->where('id', $r->id)->update([
            'nama' => $r->name,
            'email' => $r->email,
            'password' => password_hash($r->password, PASSWORD_DEFAULT),
        ]);

        return redirect()->back()->with('success', 'Data Berhasil Diupdate!');
    }


    public function hapuswali(Request $request, $id)
    {
        $w = Wali_Kelas::where('id_user', $request->id);
        $w->delete();

        $w = user::find($id);
        $w->delete();

        return redirect()->back()->with('success', 'Data Berhasil Dihapus!');
    }

    public function importWali(Request $request)
    {

        $request->validate([
            'import_file' => [
                'required',
                'file'
            ],
        ]);

        Excel::import(new WaliImport, $request->file('import_file'));

        return redirect()->back()->with('success', 'Data Berhasil Diimport!');
    }

    public function jurusan()
    {
        $jurusan = Jurusan::all();
        return view('Operator.crudJurusan', compact('jurusan'));
    }

    public function tambahJurusan(Request $request)
    {
        Jurusan::insert([
            'id_jurusan' => $request->id_jurusan,
            'nama_jurusan' => $request->nama_jurusan,
        ]);

        return redirect()->back()->with('success', 'Data Berhasil Ditambahkan!');
    }

    public function editJurusan(Request $r)
    {
        DB::table('jurusans')->where('id_jurusan', $r->id_jurusan)->update([
            'nama_jurusan' => $r->nama_jurusan,
        ]);

        return redirect()->back()->with('success', 'Data Berhasil Diupdate!');
    }

    public function hapusJurusan($id)
    {
        $j = Jurusan::find($id);
        $j->delete();

        return redirect()->back()->with('success', 'Data Berhasil Dihapus!');
    }

    public function kelas()
    {
        $kelas = Kelas::withCount('siswa')->get();
        $jurusan = Jurusan::all();
        $walikelas = Wali_Kelas::doesntHave('kelas')->get();
        return view('Operator.crudKelas', compact('walikelas', 'kelas', 'jurusan'));
    }

    public function tambahKelas(Request $request)
    {

        Kelas::insert([
            'id_jurusan' => $request->id_jurusan,
            'nomor_kelas' => $request->nomor_kelas,
            'nip' => $request->nip,
            'tingkat' => $request->tingkat,
        ]);

        return redirect()->back()->with('success', 'Data Berhasil Ditambahkan!');
    }

    public function editKelas(Request $r)
    {
        DB::table('kelas')->where('id_kelas', $r->id_kelas)->update([
            'id_jurusan' => $r->id_jurusan,
            'nomor_kelas' => $r->nomor_kelas,
            'nip' => $r->nip,
            'tingkat' => $r->tingkat,
        ]);

        return redirect()->back()->with('success', 'Data Berhasil Diupdate!');
    }

    public function hapusKelas(Request $request, $id)
    {
        // Find the Kelas record
        $kelas = Kelas::find($id);

        if ($kelas) {
            // Delete all related Siswa records
            $siswas = Siswa::where('id_kelas', $request->id_user)->get();
            foreach ($siswas as $siswa) {
                // Delete the related User record if exists
                $user = User::find($siswa->id_user);
                if ($user) {
                    $user->delete();
                }

                // Delete the Siswa record
                $siswa->delete();
            }

            // Finally, delete the Kelas record
            $kelas->delete();

            return redirect()->back()->with('success', 'Data Berhasil Dihapus!');
        } else {
            return redirect()->back()->with('warning', 'Data Tidak Ditemukan!');
        }
    }

    public function importKelas(Request $request)
    {
        $request->validate([
            'import_file' => [
                'required',
                'file'
            ],
        ]);

        Excel::import(new KelasImport, $request->file('import_file'));

        return redirect()->back()->with('success', 'Data Berhasil Diimport!');
    }

    public function siswa($id_kelas)
    {
        $kelas = Kelas::find($id_kelas);
        $siswa = $kelas->siswa()->with('user')->get();
        $waliSiswa = Wali_Siswa::all();

        return view('Operator.crudSiswa', compact('siswa', 'kelas', 'id_kelas', 'waliSiswa'));
    }

    public function tambahSiswa(Request $request)
    {
        if (strlen($request->password) > 0) {
            $user = User::create([
                'nama' => $request->name,
                'email' => $request->email,
                'password' => password_hash($request->password, PASSWORD_DEFAULT),
                'role' => 'siswa'
            ]);

            Siswa::insert([
                'nis' => $request->nis,
                'id_user' => $user->id,
                'id_kelas' => $request->id_kelas,
                'jenis_kelamin' => $request->jenis_kelamin,
                'nisn' => $request->nisn,
                'nik_ayah' => $request->nik_ayah ?? null,
                'nik_ibu' => $request->nik_ibu ?? null,
                'nik_wali' => $request->nik_wali ?? null,
            ]);
        } else {
            $user = User::create([
                'nama' => $request->name,
                'email' => $request->email,
                'role' => 'wali'
            ]);

            Siswa::insert([
                'nis' => $request->nis,
                'id_user' => $user->id,
                'id_kelas' => $request->id_kelas,
                'jenis_kelamin' => $request->jenis_kelamin,
                'nisn' => $request->nisn,
                'nik_ayah' => $request->nik_ayah ?? null,
                'nik_ibu' => $request->nik_ibu ?? null,
                'nik_wali' => $request->nik_wali ?? null,
            ]);
        }
        return redirect()->back()->with('success', 'Data Berhasil Ditambahkan!');
    }

    public function editSiswa(Request $r)
    {
        DB::table('siswas')->where('id_user', $r->id)->update([
            'nis' => $r->nis,
            'jenis_kelamin' => $r->jenis_kelamin,
            'nisn' => $r->nisn,
            'nik_ayah' => $r->nik_ayah ?? null,
            'nik_ibu' => $r->nik_ibu ?? null,
            'nik_wali' => $r->nik_wali ?? null,
        ]);


        //DB user
        DB::table('users')->where('id', $r->id)->update([
            'nama' => $r->name,
            'email' => $r->email,
            'password' => password_hash($r->password, PASSWORD_DEFAULT),
        ]);

        return redirect()->back()->with('success', 'Data Berhasil Diupdate!');
    }

    public function hapusSiswa(Request $request, $id)
    {
        $s = Siswa::where('id_user', $request->id);;
        $s->delete();

        $s = User::find($id);
        $s->delete();

        return redirect()->back()->with('success', 'Data Berhasil Dihapus!');
    }

    public function kesiswaan()
    {
        $kesiswaan = User::where('role', 'kesiswaan')->with('wali')->get();
        return view('Operator.crudKesiswaan', compact('kesiswaan'));
    }

    public function tambahKesiswaan(Request $request)
    {
        if (strlen($request->password) > 0) {
            $user = User::create([
                'nama' => $request->name,
                'email' => $request->email,
                'password' => password_hash($request->password, PASSWORD_DEFAULT),
                'role' => 'kesiswaan',
            ]);
            Wali_Kelas::insert([
                'nuptk' => $request->nuptk,
                'id_user' => $user->id,
                'jenis_kelamin' => $request->jenis_kelamin,
                'nip' => $request->nip,
            ]);
        } else {
            $user = User::create([
                'nama' => $request->name,
                'email' => $request->email,
                'role' => 'kesiswaan',
            ]);
            Wali_Kelas::insert([
                'nuptk' => $request->nuptk,
                'id_user' => $user->id,
                'jenis_kelamin' => $request->jenis_kelamin,
                'nip' => $request->nip,
            ]);
        }

        return redirect()->back()->with('success', 'Keiswaan berhasil ditambahkan!');
    }

    public function editKesiswaan(Request $r)
    {
        DB::table('wali__kelas')->where('id_user', $r->id)->update([
            'nip' => $r->nip,
            'jenis_kelamin' => $r->jenis_kelamin,
            'nuptk' => $r->nuptk,
        ]);

        DB::table('users')->where('id', $r->id)->update([
            'nama' => $r->name,
            'email' => $r->email,
            'password' => password_hash($r->password, PASSWORD_DEFAULT),
        ]);

        return redirect()->back()->with('success', 'Data Berhasil Diupdate!');
    }

    public function hapusKesiswaan($id)
    {
        $k = User::find($id);
        $k->delete();

        return redirect()->back()->with('success', 'Data Berhasil Dihapus!');
    }

    public function walisiswa()
    {
        $walisiswa = Wali_Siswa::with('user')->get();
        return view('Operator.crudWalisiswa', compact('walisiswa'));
    }

    public function tambahWalisiswa(Request $request)
    {
        if (strlen($request->password) > 0) {
            $user = User::create([
                'nama' => $request->name,
                'email' => $request->email,
                'password' => password_hash($request->password, PASSWORD_DEFAULT),
                'role' => 'kesiswaan',
            ]);
            Wali_Siswa::insert([
                'nik' => $request->nik,
                'id_user' => $user->id,
                'jenis_kelamin' => $request->jenis_kelamin,
                'alamat' => $request->alamat,
            ]);
        } else {
            $user = User::create([
                'nama' => $request->name,
                'email' => $request->email,
                'role' => 'kesiswaan',
            ]);
            Wali_Siswa::insert([
                'nik' => $request->nik,
                'id_user' => $user->id,
                'jenis_kelamin' => $request->jenis_kelamin,
                'alamat' => $request->alamat,
            ]);
        }

        return redirect()->back()->with('success', 'Keiswaan berhasil ditambahkan!');
    }

    public function editWalisiswa(Request $r)
    {
        DB::table('wali__siswas')->where('id_user', $r->id)->update([
            'nik' => $r->nik,
            'jenis_kelamin' => $r->jenis_kelamin,
            'alamat' => $r->alamat,
        ]);

        DB::table('users')->where('id', $r->id)->update([
            'nama' => $r->name,
            'email' => $r->email,
            'password' => password_hash($r->password, PASSWORD_DEFAULT),
        ]);

        return redirect()->back()->with('success', 'Data Berhasil Diupdate!');
    }

    public function hapusWalisiswa($id)
    {
        $w = Wali_Siswa::where('id_user', $id);
        $w->delete();
        
        $u = User::find($id);
        $u->delete();

        return redirect()->back()->with('success', 'Data Berhasil Dihapus!');
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
