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

Route::get('tryout{id_to}/{subtes}/{id_peserta}/finish', [App\Http\Controllers\TryoutController::class, 'subtesFinish'])->name('subtes.finish');

Route::get('{id_to}/{id_peserta}/finish', [App\Http\Controllers\TryoutController::class, 'ujianFinish'])->name('ujian.finish');

Route::get('tryout{id}/login', [App\Http\Controllers\TryoutController::class, 'showLogin'])->name('tryout.showlogin');

Route::post('tryout{id_to}/login/{id}', [App\Http\Controllers\TryoutController::class, 'login'])->name('tryout.login');

Route::get('tryout{id}', [App\Http\Controllers\TryoutController::class, 'listTO'])->name('tryout.index');

Route::get('soal/kategori/{kategori}', [App\Http\Controllers\SoalController::class, 'showCategory']);

Route::get('soal/get_subtes/{kategori}', [App\Http\Controllers\SoalController::class, 'getSubtes']);
Route::get('endtime/{id_peserta}', [App\Http\Controllers\TryoutController::class, 'getEndTime']);

Route::resource('soal', 'App\Http\Controllers\SoalController');

Route::post('soal/upload', [App\Http\Controllers\SoalController::class, 'upload'])->name('upload.upload');

Route::get('tryout/konfirmasi-peserta', [App\Http\Controllers\TryoutController::class, 'showKonfirmasiPeserta']);
Route::get('tryout/peserta-dikonfirmasi', [App\Http\Controllers\TryoutController::class, 'showPesertaDikonfirmasi'])->name('peserta.dikonfirmasi');

Route::get('setting-waktu-pengerjaan-subtes', [App\Http\Controllers\TryoutController::class, 'indexSettingWaktu'])->name('setting-waktu-pengerjaan-subtes.index');

Route::get('setting-waktu-pengerjaan-subtes/{id}/edit', [App\Http\Controllers\TryoutController::class, 'editSettingWaktu'])->name('setting-waktu-pengerjaan-subtes.edit');

Route::post('setting-waktu-pengerjaan-subtes/{id}/update', [App\Http\Controllers\TryoutController::class, 'updateSettingWaktu'])->name('setting-waktu-pengerjaan-subtes.update');

Route::resource('kupon', 'App\Http\Controllers\KuponController');
Route::resource('setting-pembayaran', 'App\Http\Controllers\PembayaranController');
Route::resource('setting-peraturan-try-out', 'App\Http\Controllers\PeraturanTOController');
Route::resource('history-try-out', 'App\Http\Controllers\HistoryTOController');

Route::get('history-try-out/{id_to}/{id_subtes}/show/{download}', [App\Http\Controllers\HistoryTOController::class, 'showNilai'])->name('show-nilai.show');
Route::get('history-try-out/{id_to}/{id_subtes}/{id_peserta}/edit', [App\Http\Controllers\HistoryTOController::class, 'editNilai'])->name('edit-nilai.edit');
Route::get('history-try-out/{id_to}/{id_subtes}/{id_peserta}/update', [App\Http\Controllers\HistoryTOController::class, 'updateNilai'])->name('update-nilai.update');
Route::get('try-out/{id_to}/publish', [App\Http\Controllers\HistoryTOController::class, 'tryoutPublish'])->name('tryout.publish');

Route::get('get_tryout', [App\Http\Controllers\KuponController::class, 'getTryout']);

Route::get('get_kupon/{id_to}', [App\Http\Controllers\KuponController::class, 'getKupon']);

Route::post('tryout/terima-peserta/{id}', [App\Http\Controllers\TryoutController::class, 'terimaPeserta']);

Route::post('tryout/tolak-peserta/{id}', [App\Http\Controllers\TryoutController::class, 'tolakPeserta']);

Route::get('notifikasi/{id}', [App\Http\Controllers\NotifikasiController::class, 'index']);

Route::get('notifikasi/detail/{id}', [App\Http\Controllers\NotifikasiController::class, 'show']);

Route::get('jumlah-notifikasi/{id}', [App\Http\Controllers\NotifikasiController::class, 'getJumlahNotif']);

Route::get('get-jawaban/{id}', [App\Http\Controllers\SoalController::class, 'getJawaban'])->name('soal.get_jawaban');

Route::get('insert-jawaban/{id_peserta}/{id_soal}/{id_jawaban}', [App\Http\Controllers\TryoutController::class, 'insertJawabanPeserta']);

Route::get('insert-ragu/{id_peserta}/{id_soal}/{ragu}', [App\Http\Controllers\TryoutController::class, 'insertRagu']);