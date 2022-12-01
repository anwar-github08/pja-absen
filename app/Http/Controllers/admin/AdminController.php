<?php

namespace App\Http\Controllers\admin;

use App\Models\Izin;
use App\Models\Absen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kunjungan;

class AdminController extends Controller
{
    public function showImage($kategori, $image)
    {
        if ($kategori == 'datang') {
            $title = 'Foto Datang';
        } else {
            $title = 'Foto Pulang';
        }

        return view('admin.show_image', [
            'title' => $title,
            'kategori' => $kategori,
            'image' => $image
        ]);
    }

    public function detailAbsen($id)
    {

        return view('admin.detail_absen', [
            'title' => 'Detail Absen',
            'absens' => Absen::where('id', $id)->with('karyawan')->with('datang')->with('is_keluar')->with('is_masuk')->with('pulang')->with('izin')->get()
        ]);
    }

    public function detailIzin($id)
    {

        return view('admin.detail_izin', [
            'title' => 'Detail Izin',
            'izins' => Izin::where('id', $id)->with('karyawan')->get()
        ]);
    }

    public function detailKunjungan($id)
    {

        return view('admin.detail_kunjungan', [
            'title' => 'Detail Kunjungan',
            'kunjungans' => Kunjungan::where('id', $id)->with('karyawan')->get()
        ]);
    }

    public function export()
    {

        return view('admin.export', [
            'title' => 'Export'
        ]);
    }

    public function exportAbsen()
    {

        return view('admin.export.export_absen', [
            'title' => 'Export'
        ]);
    }
}
