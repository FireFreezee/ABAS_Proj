<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\KesiswaanController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\WalisiswaController;
use App\Http\Middleware\Operator;
use App\Http\Middleware\Walisiswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    if (auth()->check()) {
        $role = auth()->user()->role;

        if ($role == 'kesiswaan') {
            return redirect('kesiswaan');
        } elseif ($role == 'siswa') {
            return redirect('siswa');
        } elseif ($role == 'wali') {
            return redirect('walikelas');
        } elseif ($role == 'operator') {
            return redirect('operator');
        } elseif ($role == 'walis') {
            return redirect('walisiswa');
        } else {
            return redirect('/home');
        }
    }
    return view('Login.login');
})->name('log');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'Walikelas:walikelas'])->group(function () {
    Route::resource('walikelas', App\Http\Controllers\WalikelasController::class);
});

Route::middleware(['auth', 'Siswa:siswa'])->group(function () {
    Route::get('siswa', [SiswaController::class, 'index'])->name('siswa-dashboard');
    Route::get('siswa/profile', [SiswaController::class, 'profile'])->name('siswa-profile');
    Route::post('/siswa/editprofil', [SiswaController::class, 'editprofil'])->name('edit-profil');
    Route::post('/profile-update', [SiswaController::class, 'photo_profile'])->name('update-profile');
    Route::get('/siswa/absen', [SiswaController::class, 'absen'])->name('siswa-absen');
    Route::post('/absen/store', [SiswaController::class, 'store']);
    Route::get('/siswa/izin', [SiswaController::class, 'izin'])->name('siswa-izin');
    Route::post('/izin/store', [SiswaController::class, 'izin_store'])->name('izin-store');
    Route::get('/siswa/laporan', [SiswaController::class, 'laporan'])->name('siswa-laporan');
    Route::post('/fileUpload', [SiswaController::class, 'fileUpload'])->name('file-upload');
});

Route::middleware(['auth', 'Walisiswa:walisiswa'])->group(function () {
   Route::get('walisiswa', [WalisiswaController::class, 'index'])->name('walsis-dashboard');
});

Route::middleware(['auth', 'Operator:operator'])->group(function () {
    Route::get('operator', [App\Http\Controllers\operatorController::class, 'lokasisekolah'])->name('Dashboard');

    Route::get('/operator/data-walikelas', [OperatorController::class, 'dataWali'])->name('data-wali');
    Route::post('/store-wali-kelas', [OperatorController::class, 'store'])->name('store-wali-kelas');
    Route::post('/editwalikelas/{id}', [OperatorController::class, 'editwali'])->name('edit-wali-kelas');
    Route::delete('hapuswalikelas/{id}', [OperatorController::class, 'hapuswali'])->name('hapuswali');
    Route::post('/walikelas/import', [OperatorController::class, 'importWali'])->name('import-wali');

    Route::get('/operator/data-jurusan', [OperatorController::class, 'jurusan'])->name('data-jurusan');
    Route::post('/add-jurusan', [OperatorController::class, 'tambahJurusan'])->name('add-jurusan');
    Route::post('/edit-jurusan/{id_jurusan}', [OperatorController::class, 'editJurusan'])->name('edit-jurusan');
    Route::delete('/hapus-jurusan/{id}', [OperatorController::class, 'hapusJurusan'])->name('hapus-jurusan');

    Route::get('/operator/data-kelas', [OperatorController::class, 'kelas'])->name('data-kelas');
    Route::post('/add-kelas', [OperatorController::class, 'tambahKelas'])->name('add-kelas');
    Route::post('/edit-kelas/{id_kelas}', [OperatorController::class, 'editKelas'])->name('edit-kelas');
    Route::delete('/hapus-kelas/{id}', [OperatorController::class, 'hapusKelas'])->name('hapus-kelas');
    Route::post('/kelas/import', [OperatorController::class, 'importKelas'])->name('import-kelas');

    Route::get('/kelas/{id}/data-siswa/', [OperatorController::class, 'siswa'])->name('data-siswa');
    Route::post('/kelas/{id}/add-siswa', [OperatorController::class, 'tambahSiswa'])->name('add-siswa');
    Route::post('/kelas/{id}/edit-siswa', [OperatorController::class, 'editSiswa'])->name('edit-siswa');
    Route::delete('/kelas/{id}/hapus-siswa', [OperatorController::class, 'hapusSiswa'])->name('hapus-siswa');

    Route::get('/operator/data-kesiswaan', [OperatorController::class, 'kesiswaan'])->name('data-kesiswaan');
    Route::post('/tambah-kesiswaan', [OperatorController::class, 'tambahKesiswaan'])->name('tambah-kesiswaan');
    Route::post('/edit-kesiswaan/{id}', [OperatorController::class, 'editKesiswaan'])->name('edit-kesiswaan');
    Route::delete('/hapus-kesiswaan/{id}', [OperatorController::class, 'hapusKesiswaan'])->name('hapus-kesiswaan');

    Route::post('/operator/updatelokasisekolah', [OperatorController::class, 'updatelokasisekolah'])->name('updatelokasi');
    Route::post('/operator/updatewaktu', [OperatorController::class, 'updatewaktu'])->name('updatewaktu');

});

Route::middleware(['auth', 'Kesiswaan:kesiswaan'])->group(function () {
 Route::get('/kesiswaan', [KesiswaanController::class, 'index'])->name("kesiswaan.index");
});
