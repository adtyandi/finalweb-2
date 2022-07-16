<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/pengajuan-kredit/create', [App\Http\Controllers\PengajuanKreditController::class, 'create'])->name('pengajuan-kredit.create');
Route::post('/pengajuan-kredit/store', [App\Http\Controllers\PengajuanKreditController::class, 'store'])->name('pengajuan-kredit.store');
Route::resource('/profile', App\Http\Controllers\ProfileController::class);

Route::middleware('role:admin|customerservice|kabaganalis|staffanalis')->group(function () {
    Route::get('/pengajuan-kredit', [App\Http\Controllers\PengajuanKreditController::class, 'index'])->name('pengajuan-kredit.index');
    Route::get('/kode-berkas', [App\Http\Controllers\KodeBerkasController::class, 'index'])->name('kode-berkas.index');
    Route::get('/pengajuan-kredit/{id}/edit', [App\Http\Controllers\PengajuanKreditController::class, 'edit'])->name('pengajuan-kredit.edit');
    Route::put('/pengajuan-kredit/{id}', [App\Http\Controllers\PengajuanKreditController::class, 'update'])->name('pengajuan-kredit.update');
    Route::get('/pengajuan-kredit/verifikasi', [App\Http\Controllers\PengajuanKreditController::class, 'verifikasi'])->name('pengajuan-kredit.verifikasi');
    Route::post('/pengajuan-kredit/verifikasi/store', [App\Http\Controllers\PengajuanKreditController::class, 'verifikasi_store'])->name('verifikasi.store');
    Route::delete('/berkas/{id}', [App\Http\Controllers\PengajuanKreditController::class, 'berkas_destroy'])->name('berkas.destroy');
});

// Route::middleware('role:admin')->group(function () {
    Route::post('/kode-berkas/store', [App\Http\Controllers\KodeBerkasController::class, 'store'])->name('kode-berkas.store');
    Route::put('/kode-berkas/{id}', [App\Http\Controllers\KodeBerkasController::class, 'update'])->name('kode-berkas.update');
    Route::delete('/kode-berkas/{id}', [App\Http\Controllers\KodeBerkasController::class, 'destroy'])->name('kode-berkas.destroy');
    Route::delete('/pengajuan-kredit/{id}', [App\Http\Controllers\PengajuanKreditController::class, 'destroy'])->name('pengajuan-kredit.destroy');
    Route::put('/pengajuan-kredit/qrcode/{id}', [App\Http\Controllers\PengajuanKreditController::class, 'update_qrcode'])->name('pengajuan-kredit.qrcode');
    Route::resource('/manajemen-pengguna', App\Http\Controllers\ManajemenUserController::class);
// });
