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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/daftar-to/{id_to}/{id_user}', [App\Http\Controllers\HomeController::class, 'daftar']);

Route::post('/daftar-to/{id_to}/{id_user}/transaksi', [App\Http\Controllers\HomeController::class, 'transaksi']);

Route::get('transaksi/{id_transaksi}', [App\Http\Controllers\HomeController::class, 'showTransaksi']);

Route::get('transaksi/{id_transaksi}/delete', [App\Http\Controllers\HomeController::class, 'deleteTransaksi']);

Route::resource('/profile', 'App\Http\Controllers\UserProfileController');

Route::resource('data-tryout', 'App\Http\Controllers\TryoutController');

Route::get('tryout{id_to}/{subtes}/{id_no}', [App\Http\Controllers\TryoutController::class, 'showSoal']);

Route::get('tryout{id}/login', [App\Http\Controllers\TryoutController::class, 'showLogin'])->name('tryout.showlogin');

Route::post('tryout{id_to}/login/{id}', [App\Http\Controllers\TryoutController::class, 'login'])->name('tryout.login');

Route::get('tryout{id}', [App\Http\Controllers\TryoutController::class, 'listTO'])->name('tryout.index');

Route::get('soal/kategori/{kategori}', [App\Http\Controllers\SoalController::class, 'showCategory']);

Route::get('soal/get_subtes/{kategori}', [App\Http\Controllers\SoalController::class, 'getSubtes']);

Route::resource('soal', 'App\Http\Controllers\SoalController');

Route::post('soal/upload', [App\Http\Controllers\SoalController::class, 'upload'])->name('upload.upload');

Route::get('tryout/konfirmasi-peserta', [App\Http\Controllers\TryoutController::class, 'showKonfirmasiPeserta']);

Route::resource('kupon', 'App\Http\Controllers\KuponController');

Route::get('get_tryout', [App\Http\Controllers\KuponController::class, 'getTryout']);

Route::get('get_kupon/{id_to}', [App\Http\Controllers\KuponController::class, 'getKupon']);

Route::post('tryout/terima-peserta/{id}', [App\Http\Controllers\TryoutController::class, 'terimaPeserta']);

Route::post('tryout/tolak-peserta/{id}', [App\Http\Controllers\TryoutController::class, 'tolakPeserta']);

Route::get('notifikasi/{id}', [App\Http\Controllers\NotifikasiController::class, 'index']);

Route::get('notifikasi/detail/{id}', [App\Http\Controllers\NotifikasiController::class, 'show']);

Route::get('jumlah-notifikasi/{id}', [App\Http\Controllers\NotifikasiController::class, 'getJumlahNotif']);

Route::get('get-jawaban/{id}', [App\Http\Controllers\SoalController::class, 'getJawaban'])->name('soal.get_jawaban');