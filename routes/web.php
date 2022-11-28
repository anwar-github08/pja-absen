<?php

use App\Models\Jabatan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IzinController;
use App\Http\Controllers\DatangController;
use App\Http\Controllers\PulangController;
use App\Http\Controllers\IstirahatController;
use App\Http\Controllers\KunjunganController;
use App\Http\Controllers\admin\AdminController;
use App\Models\JabatanKunjungan;

use Stevebauman\Location\Facades\Location;
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
        'title' => 'SIGASIK',
        'jabatans' => JabatanKunjungan::with('jabatan')->get()
    ]);
});

Route::get('/home', function ($id) {
    return view('home', [
        'title' => 'SIGASIK',
        'id_jabatan' => $id,
        'jabatans' => Jabatan::all()
    ]);
});

Route::get('/datang', [DatangController::class, 'index']);
Route::get('/pulang', [PulangController::class, 'index']);
Route::get('/is_keluar', [IstirahatController::class, 'isKeluar']);
Route::get('/is_masuk', [IstirahatController::class, 'isMasuk']);
Route::get('/izin', [IzinController::class, 'index']);
Route::get('/kunjungan/{id_jabatan}', [KunjunganController::class, 'index']);



// lokasi
Route::get('/lokasi', function () {

    // get ip public
    $ip = file_get_contents("https://api.ipify.org");

    // get location geoplugin
    $geoplugin = file_get_contents("http://www.geoplugin.net/php.gp?id=" . $ip);

    // get location torran geoapi
    $torran = geoip()->getLocation($ip);

    // get location stevebauman
    if ($position = Location::get($ip)) {
        dd($position, $position->cityName, $position->latitude . ',' . $position->longitude);
    } else {
        dd('gagal');
    }
});





// admin
Route::get('/admin', function () {
    return view('admin.dashboard', [
        'title' => 'Dashboard'
    ]);
});

Route::get('/data_absen', function () {
    return view('admin.data_absen', [
        'title' => 'Data Absen'
    ]);
});

Route::get('/data_kunjungan', function () {
    return view('admin.data_kunjungan', [
        'title' => 'Data Kunjungan'
    ]);
});

Route::get('/karyawan', function () {
    return view('admin.karyawan', [
        'title' => 'Data Karyawan'
    ]);
});

Route::get('/jabatan', function () {
    return view('admin.jabatan', [
        'title' => 'Data Jabatan'
    ]);
});

Route::get('/akses_kunjungan', function () {
    return view('admin.akses_kunjungan', [
        'title' => 'Akses Kunjungan'
    ]);
});



// Route::get('showImage/{kategori}/{image}', [AdminController::class, 'showImage']);
Route::get('/detailAbsen/{id}', [AdminController::class, 'detailAbsen']);
Route::get('/detailIzin/{id}', [AdminController::class, 'detailIzin']);
