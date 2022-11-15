<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DatangController;
use App\Http\Controllers\PulangController;
use App\Http\Controllers\IstirahatController;

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
    return view('index', [
        'title' => 'PJA-ABSEN'
    ]);
});


Route::get('/datang', [DatangController::class, 'index']);
Route::get('/pulang', [PulangController::class, 'index']);
Route::get('/is_keluar', [IstirahatController::class, 'isKeluar']);
Route::get('/is_masuk', [IstirahatController::class, 'isMasuk']);
