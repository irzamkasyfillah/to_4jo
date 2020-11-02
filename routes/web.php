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
    return view('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/profile', 'App\Http\Controllers\UserProfileController');

Route::resource('/data-tryout', 'App\Http\Controllers\TryoutController');

Route::get('list-to/{subtes}/{id}', [App\Http\Controllers\TryoutController::class, 'showSoal'])->name('to/subtes');

Route::get('list-to', [App\Http\Controllers\TryoutController::class, 'listTO'])->name('to/list-to');

Route::get('soal/kategori/{kategori}', [App\Http\Controllers\SoalController::class, 'showCategory']);

Route::get('soal/get_subtes/{kategori}', [App\Http\Controllers\SoalController::class, 'getSubtes']);

Route::resource('soal', 'App\Http\Controllers\SoalController');