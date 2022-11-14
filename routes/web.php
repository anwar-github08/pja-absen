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
    return view('index', [
        'title' => 'PJA-ABSEN'
    ]);
});


Route::get('/datang', function () {
    return view('datang', [
        'title' => 'Absen Datang'
    ]);
});

Route::get('/pulang', function () {
    return view('pulang', [
        'title' => 'Absen Pulang'
    ]);
});
