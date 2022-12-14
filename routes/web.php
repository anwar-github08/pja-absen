<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IzinController;
use App\Http\Controllers\DatangController;
use App\Http\Controllers\PulangController;
use App\Http\Controllers\IstirahatController;
use App\Http\Controllers\KunjunganController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\LoginController;
use App\Http\Controllers\LokasiController;
use App\Models\Karyawan;
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


// Route::get('/home', function ($id) {
//     return view('home', [
//         'title' => 'SIGASIK',
//         'id_jabatan' => $id,
//         'jabatans' => Jabatan::all()
//     ]);
// });

// lokasi
Route::get('/lokasi', [LokasiController::class, 'index']);

// rute middleware guest->bisa diakses ketika belum login
Route::middleware('guest')->group(function () {

    // login
    Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
    Route::post('/login', [LoginController::class, 'auth']);
});


// rute middleware auth->bisa diakses ketika sudah login
Route::middleware('auth')->group(function () {

    Route::get('/', function () {
        $karyawan = Karyawan::select('nama_karyawan')->where('id', auth()->user()->karyawan_id)->first();
        return view('index', [
            'title' => 'SIGASIK',
            'nama_karyawan' => $karyawan->nama_karyawan,
            'jama' => strtotime('07:30') - strtotime('07:11')
        ]);
    });

    Route::get('/datang', [DatangController::class, 'index']);
    Route::get('/pulang', [PulangController::class, 'index']);
    Route::get('/is_keluar', [IstirahatController::class, 'isKeluar']);
    Route::get('/is_masuk', [IstirahatController::class, 'isMasuk']);
    Route::get('/izin', [IzinController::class, 'index']);

    // logout
    Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');
});


// rute middleware kunjungan->bisa akses kunjungan
Route::middleware('kunjungan')->group(function () {
    Route::get('/kunjungan', [KunjunganController::class, 'index']);
});


// rute middleware admin->bisa mengakses admin
Route::middleware('admin')->group(function () {

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

    Route::get('/data_izin', function () {
        return view('admin.data_izin', [
            'title' => 'Data Izin'
        ]);
    });

    Route::get('/jam_kerja', function () {
        return view('admin.jam_kerja', [
            'title' => 'Jam Kerja'
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
    Route::get('/detailKunjungan/{id}', [AdminController::class, 'detailKunjungan']);

    // export
    Route::get('/exportExcelAbsen/{tanggal}', [AdminController::class, 'exportExcelAbsen']);
    Route::get('/exportPdfAbsen/{tanggal}', [AdminController::class, 'exportPdfAbsen']);

    Route::get('/exportExcelKunjungan/{tanggal}', [AdminController::class, 'exportExcelKunjungan']);
    Route::get('/exportPdfKunjungan/{tanggal}', [AdminController::class, 'exportPdfKunjungan']);

    Route::get('/exportExcelIzin/{tanggal}', [AdminController::class, 'exportExcelIzin']);
    Route::get('/exportPdfIzin/{tanggal}', [AdminController::class, 'exportPdfIzin']);
});
