<?php

use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\AlternatifKriteriaController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\PerhitunganController;
use App\Http\Controllers\SubKriteriaController;
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
    return view('dashboard');
});
Route::resource('kriteria', KriteriaController::class);
Route::resource('sub_kriteria', SubKriteriaController::class);
Route::resource('alternatif', AlternatifController::class);
Route::resource('alternatif_kriteria', AlternatifKriteriaController::class);
Route::get('/perhitungan', [PerhitunganController::class, 'index']);
Route::get('/hasil', [PerhitunganController::class, 'hasil']);
