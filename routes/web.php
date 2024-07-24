<?php

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
        } else {
            return redirect('/home');
        }
    }
    return view('Login.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'Walikelas:walikelas'])->group(function () {
    Route::resource('walikelas', App\Http\Controllers\WalikelasController::class);
});

Route::middleware(['auth', 'Siswa:siswa'])->group(function () {
    Route::resource('siswa', App\Http\Controllers\siswaController::class);
});

Route::middleware(['auth', 'Operator:operator'])->group(function () {
    Route::resource('operator', App\Http\Controllers\operatorController::class);
});

