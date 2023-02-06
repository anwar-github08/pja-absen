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
            'absens' => Absen::where('id', $id)->with('karyawan')->with('datang')->with('is_keluar')->with('is_masuk')->with('pulang')->get()
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


    // export
    public function exportExcelAbsen($tanggal)
    {
        $tanggal = explode(' ', $tanggal);

        if (count($tanggal) == 1) {
            $absens = Absen::where('tanggal_absen', date('Y-m-d', strtotime($tanggal[0])))->with('karyawan')->with('datang')->with('is_keluar')->with('is_masuk')->with('pulang')->get();

            $tanggal = date('d/m/Y', strtotime($tanggal[0]));
        } else {

            $tanggalAwal = date('Y-m-d', strtotime($tanggal[0]));
            $tanggalAkhir = date('Y-m-d', strtotime($tanggal[2]));

            $absens = Absen::whereBetween('tanggal_absen', [$tanggalAwal, $tanggalAkhir])->orderby('tanggal_absen', 'desc')->with('karyawan')->with('datang')->with('is_keluar')->with('is_masuk')->with('pulang')->get();

            $tanggal = date('d/m/Y', strtotime($tanggalAwal)) . ' - ' . date('d/m/Y', strtotime($tanggalAkhir));
        }



        for ($i = 0; $i < count($absens); $i++) {

            $url = 'http://192.168.10.3:8002/storage/foto_datang/' . $absens[$i]['datang']['foto_datang'];

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $url);

            $data = curl_exec($ch);
            curl_close($ch);

            file_put_contents($absens[$i]['datang']['foto_datang'], $data);
        }


        return view('admin.export.export_excel_absen', [
            'title' => 'Export',
            'tanggal' => $tanggal,
            'absens' => $absens
        ]);
    }

    public function exportPdfAbsen($tanggal)
    {
        $tanggal = explode(' ', $tanggal);

        if (count($tanggal) == 1) {
            $absens = Absen::where('tanggal_absen', date('Y-m-d', strtotime($tanggal[0])))->with('karyawan')->with('datang')->with('is_keluar')->with('is_masuk')->with('pulang')->get();

            $tanggal = date('d/m/Y', strtotime($tanggal[0]));
        } else {

            $tanggalAwal = date('Y-m-d', strtotime($tanggal[0]));
            $tanggalAkhir = date('Y-m-d', strtotime($tanggal[2]));

            $absens = Absen::whereBetween('tanggal_absen', [$tanggalAwal, $tanggalAkhir])->orderby('tanggal_absen', 'desc')->with('karyawan')->with('datang')->with('is_keluar')->with('is_masuk')->with('pulang')->get();

            $tanggal = date('d/m/Y', strtotime($tanggalAwal)) . ' - ' . date('d/m/Y', strtotime($tanggalAkhir));
        }

        return view('admin.export.export_pdf_absen', [
            'title' => 'Export',
            'tanggal' => $tanggal,
            'absens' => $absens
        ]);
    }


    public function exportExcelKunjungan($tanggal)
    {
        $tanggal = explode(' ', $tanggal);

        if (count($tanggal) == 1) {
            $kunjungans = Kunjungan::where('tanggal_kunjungan', date('Y-m-d', strtotime($tanggal[0])))->with('karyawan')->get();

            $tanggal = date('d/m/Y', strtotime($tanggal[0]));
        } else {

            $tanggalAwal = date('Y-m-d', strtotime($tanggal[0]));
            $tanggalAkhir = date('Y-m-d', strtotime($tanggal[2]));

            $kunjungans = Kunjungan::whereBetween('tanggal_kunjungan', [$tanggalAwal, $tanggalAkhir])->orderby('tanggal_kunjungan', 'desc')->with('karyawan')->get();

            $tanggal = date('d/m/Y', strtotime($tanggalAwal)) . ' - ' . date('d/m/Y', strtotime($tanggalAkhir));
        }
        return view('admin.export.export_excel_kunjungan', [
            'title' => 'Export',
            'tanggal' => $tanggal,
            'kunjungans' => $kunjungans
        ]);
    }

    public function exportPdfKunjungan($tanggal)
    {
        $tanggal = explode(' ', $tanggal);

        if (count($tanggal) == 1) {
            $kunjungans = Kunjungan::where('tanggal_kunjungan', date('Y-m-d', strtotime($tanggal[0])))->with('karyawan')->get();

            $tanggal = date('d/m/Y', strtotime($tanggal[0]));
        } else {

            $tanggalAwal = date('Y-m-d', strtotime($tanggal[0]));
            $tanggalAkhir = date('Y-m-d', strtotime($tanggal[2]));

            $kunjungans = Kunjungan::whereBetween('tanggal_kunjungan', [$tanggalAwal, $tanggalAkhir])->orderby('tanggal_kunjungan', 'desc')->with('karyawan')->get();

            $tanggal = date('d/m/Y', strtotime($tanggalAwal)) . ' - ' . date('d/m/Y', strtotime($tanggalAkhir));
        }
        return view('admin.export.export_pdf_kunjungan', [
            'title' => 'Export',
            'tanggal' => $tanggal,
            'kunjungans' => $kunjungans
        ]);
    }

    public function exportExcelIzin($tanggal)
    {
        $tanggal = explode(' ', $tanggal);

        if (count($tanggal) == 1) {
            $izins = Izin::where('tanggal_izin', date('Y-m-d', strtotime($tanggal[0])))->with('karyawan')->get();

            $tanggal = date('d/m/Y', strtotime($tanggal[0]));
        } else {

            $tanggalAwal = date('Y-m-d', strtotime($tanggal[0]));
            $tanggalAkhir = date('Y-m-d', strtotime($tanggal[2]));

            $izins = Izin::whereBetween('tanggal_izin', [$tanggalAwal, $tanggalAkhir])->orderby('tanggal_izin', 'desc')->with('karyawan')->get();

            $tanggal = date('d/m/Y', strtotime($tanggalAwal)) . ' - ' . date('d/m/Y', strtotime($tanggalAkhir));
        }

        return view('admin.export.export_excel_izin', [
            'title' => 'Export',
            'tanggal' => $tanggal,
            'izins' => $izins
        ]);
    }

    public function exportPdfIzin($tanggal)
    {
        $tanggal = explode(' ', $tanggal);

        if (count($tanggal) == 1) {
            $izins = Izin::where('tanggal_izin', date('Y-m-d', strtotime($tanggal[0])))->with('karyawan')->get();

            $tanggal = date('d/m/Y', strtotime($tanggal[0]));
        } else {

            $tanggalAwal = date('Y-m-d', strtotime($tanggal[0]));
            $tanggalAkhir = date('Y-m-d', strtotime($tanggal[2]));

            $izins = Izin::whereBetween('tanggal_izin', [$tanggalAwal, $tanggalAkhir])->orderby('tanggal_izin', 'desc')->with('karyawan')->get();

            $tanggal = date('d/m/Y', strtotime($tanggalAwal)) . ' - ' . date('d/m/Y', strtotime($tanggalAkhir));
        }

        return view('admin.export.export_pdf_izin', [
            'title' => 'Export',
            'tanggal' => $tanggal,
            'izins' => $izins
        ]);
    }
}
