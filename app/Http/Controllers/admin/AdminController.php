<?php

namespace App\Http\Controllers\admin;

use ZipArchive;
use App\Models\Izin;
use App\Models\Absen;
use App\Models\Kunjungan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

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
    public function exportFotoDatang($tanggal)
    {
        $tanggal = explode(' ', $tanggal);

        if (count($tanggal) == 1) {
            $absens = Absen::where('tanggal_absen', date('Y-m-d', strtotime($tanggal[0])))->orderby('tanggal_absen', 'asc')->with('karyawan')->with('datang')->with('is_keluar')->with('is_masuk')->with('pulang')->get();

            $tanggal = date('d/m/Y', strtotime($tanggal[0]));
        } else {

            $tanggalAwal = date('Y-m-d', strtotime($tanggal[0]));
            $tanggalAkhir = date('Y-m-d', strtotime($tanggal[2]));

            $absens = Absen::whereBetween('tanggal_absen', [$tanggalAwal, $tanggalAkhir])->orderby('tanggal_absen', 'asc')->with('karyawan')->with('datang')->with('is_keluar')->with('is_masuk')->with('pulang')->get();

            $tanggal = date('d/m/Y', strtotime($tanggalAwal)) . ' - ' . date('d/m/Y', strtotime($tanggalAkhir));
        }

        // download multiple file dengan zip
        $zip = new ZipArchive;
        // membuat nama zip
        $filename = 'foto_datang.zip';

        if ($zip->open($filename, ZipArchive::CREATE)) {

            foreach ($absens as $absen) {
                if ($absen['datang']['foto_datang'] == null) {
                    $nameInZip = 'anonymous.png';
                } else {
                    $nameInZip = basename($absen['datang']['foto_datang']);
                }

                // for hosting
                // $zip->addFile('/home/pakisjay/pja-absen/storage/app/public/foto_datang/'.$nameInZip, $nameInZip);
                $zip->addFile(public_path('/storage/foto_datang/' . $nameInZip), $nameInZip);
            }

            $zip->close();
        }

        return response()->download($filename);
    }


    public function exportFotoPulang($tanggal)
    {
        $tanggal = explode(' ', $tanggal);

        if (count($tanggal) == 1) {
            $absens = Absen::where('tanggal_absen', date('Y-m-d', strtotime($tanggal[0])))->orderby('tanggal_absen', 'asc')->with('karyawan')->with('datang')->with('is_keluar')->with('is_masuk')->with('pulang')->get();

            $tanggal = date('d/m/Y', strtotime($tanggal[0]));
        } else {

            $tanggalAwal = date('Y-m-d', strtotime($tanggal[0]));
            $tanggalAkhir = date('Y-m-d', strtotime($tanggal[2]));

            $absens = Absen::whereBetween('tanggal_absen', [$tanggalAwal, $tanggalAkhir])->orderby('tanggal_absen', 'asc')->with('karyawan')->with('datang')->with('is_keluar')->with('is_masuk')->with('pulang')->get();

            $tanggal = date('d/m/Y', strtotime($tanggalAwal)) . ' - ' . date('d/m/Y', strtotime($tanggalAkhir));
        }

        // download multiple file dengan zip
        $zip = new ZipArchive;
        // membuat nama zip
        $filename = 'foto_pulang.zip';

        if ($zip->open($filename, ZipArchive::CREATE)) {

            foreach ($absens as $absen) {
                if ($absen['pulang']['foto_pulang'] == null) {
                    $nameInZip = 'anonymous.png';
                } else {
                    $nameInZip = basename($absen['pulang']['foto_pulang']);
                }
                $zip->addFile(public_path('/storage/foto_pulang/' . $nameInZip), $nameInZip);
            }

            $zip->close();
        }
        return response()->download($filename);
    }


    public function exportFotoKunjungan($tanggal)
    {
        $tanggal = explode(' ', $tanggal);

        if (count($tanggal) == 1) {
            $kunjungans = Kunjungan::where('tanggal_kunjungan', date('Y-m-d', strtotime($tanggal[0])))->orderby('tanggal_kunjungan', 'asc')->with('karyawan')->get();

            $tanggal = date('d/m/Y', strtotime($tanggal[0]));
        } else {

            $tanggalAwal = date('Y-m-d', strtotime($tanggal[0]));
            $tanggalAkhir = date('Y-m-d', strtotime($tanggal[2]));

            $kunjungans = Kunjungan::whereBetween('tanggal_kunjungan', [$tanggalAwal, $tanggalAkhir])->orderby('tanggal_kunjungan', 'asc')->with('karyawan')->get();

            $tanggal = date('d/m/Y', strtotime($tanggalAwal)) . ' - ' . date('d/m/Y', strtotime($tanggalAkhir));
        }

        // download multiple file dengan zip
        $zip = new ZipArchive;
        // membuat nama zip
        $filename = 'foto_kunjungan.zip';

        if ($zip->open($filename, ZipArchive::CREATE)) {

            foreach ($kunjungans as $kunjungan) {
                if ($kunjungan['foto_kunjungan'] == null) {
                    $nameInZip = 'anonymous.png';
                } else {
                    $nameInZip = basename($kunjungan['foto_kunjungan']);
                }
                $zip->addFile(public_path('/storage/foto_kunjungan/' . $nameInZip), $nameInZip);
            }

            $zip->close();
        }

        return response()->download($filename);
    }


    public function exportExcelAbsen($tanggal)
    {
        $tanggal = explode(' ', $tanggal);

        if (count($tanggal) == 1) {
            $absens = Absen::where('tanggal_absen', date('Y-m-d', strtotime($tanggal[0])))->orderby('tanggal_absen', 'asc')->with('karyawan')->with('datang')->with('is_keluar')->with('is_masuk')->with('pulang')->get();

            $tanggal = date('d/m/Y', strtotime($tanggal[0]));
        } else {

            $tanggalAwal = date('Y-m-d', strtotime($tanggal[0]));
            $tanggalAkhir = date('Y-m-d', strtotime($tanggal[2]));

            $absens = Absen::whereBetween('tanggal_absen', [$tanggalAwal, $tanggalAkhir])->orderby('tanggal_absen', 'asc')->with('karyawan')->with('datang')->with('is_keluar')->with('is_masuk')->with('pulang')->get();

            $tanggal = date('d/m/Y', strtotime($tanggalAwal)) . ' - ' . date('d/m/Y', strtotime($tanggalAkhir));
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
            $absens = Absen::where('tanggal_absen', date('Y-m-d', strtotime($tanggal[0])))->orderby('tanggal_absen', 'asc')->with('karyawan')->with('datang')->with('is_keluar')->with('is_masuk')->with('pulang')->get();

            $tanggal = date('d/m/Y', strtotime($tanggal[0]));
        } else {

            $tanggalAwal = date('Y-m-d', strtotime($tanggal[0]));
            $tanggalAkhir = date('Y-m-d', strtotime($tanggal[2]));

            $absens = Absen::whereBetween('tanggal_absen', [$tanggalAwal, $tanggalAkhir])->orderby('tanggal_absen', 'asc')->with('karyawan')->with('datang')->with('is_keluar')->with('is_masuk')->with('pulang')->get();

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
            $kunjungans = Kunjungan::where('tanggal_kunjungan', date('Y-m-d', strtotime($tanggal[0])))->orderby('tanggal_kunjungan', 'asc')->with('karyawan')->get();

            $tanggal = date('d/m/Y', strtotime($tanggal[0]));
        } else {

            $tanggalAwal = date('Y-m-d', strtotime($tanggal[0]));
            $tanggalAkhir = date('Y-m-d', strtotime($tanggal[2]));

            $kunjungans = Kunjungan::whereBetween('tanggal_kunjungan', [$tanggalAwal, $tanggalAkhir])->orderby('tanggal_kunjungan', 'asc')->with('karyawan')->get();

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
            $kunjungans = Kunjungan::where('tanggal_kunjungan', date('Y-m-d', strtotime($tanggal[0])))->orderby('tanggal_kunjungan', 'asc')->with('karyawan')->get();

            $tanggal = date('d/m/Y', strtotime($tanggal[0]));
        } else {

            $tanggalAwal = date('Y-m-d', strtotime($tanggal[0]));
            $tanggalAkhir = date('Y-m-d', strtotime($tanggal[2]));

            $kunjungans = Kunjungan::whereBetween('tanggal_kunjungan', [$tanggalAwal, $tanggalAkhir])->orderby('tanggal_kunjungan', 'asc')->with('karyawan')->get();

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
            $izins = Izin::where('tanggal_izin', date('Y-m-d', strtotime($tanggal[0])))->orderby('tanggal_izin', 'asc')->with('karyawan')->get();

            $tanggal = date('d/m/Y', strtotime($tanggal[0]));
        } else {

            $tanggalAwal = date('Y-m-d', strtotime($tanggal[0]));
            $tanggalAkhir = date('Y-m-d', strtotime($tanggal[2]));

            $izins = Izin::whereBetween('tanggal_izin', [$tanggalAwal, $tanggalAkhir])->orderby('tanggal_izin', 'asc')->with('karyawan')->get();

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
            $izins = Izin::where('tanggal_izin', date('Y-m-d', strtotime($tanggal[0])))->orderby('tanggal_izin', 'asc')->with('karyawan')->get();

            $tanggal = date('d/m/Y', strtotime($tanggal[0]));
        } else {

            $tanggalAwal = date('Y-m-d', strtotime($tanggal[0]));
            $tanggalAkhir = date('Y-m-d', strtotime($tanggal[2]));

            $izins = Izin::whereBetween('tanggal_izin', [$tanggalAwal, $tanggalAkhir])->orderby('tanggal_izin', 'asc')->with('karyawan')->get();

            $tanggal = date('d/m/Y', strtotime($tanggalAwal)) . ' - ' . date('d/m/Y', strtotime($tanggalAkhir));
        }

        return view('admin.export.export_pdf_izin', [
            'title' => 'Export',
            'tanggal' => $tanggal,
            'izins' => $izins
        ]);
    }
}
