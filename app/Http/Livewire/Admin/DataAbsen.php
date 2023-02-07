<?php

namespace App\Http\Livewire\Admin;

use App\Models\Absen;
use App\Models\Datang;
use App\Models\Pulang;
use App\Models\IsMasuk;
use Livewire\Component;
use App\Models\IsKeluar;

class DataAbsen extends Component
{
    public $absens;
    public $tanggal = '';

    public function mount()
    {
        $this->tanggal = date('Y-m-d');
        $this->absens = Absen::where('tanggal_absen', date('Y-m-d'))->with('karyawan')->with('datang')->with('is_keluar')->with('is_masuk')->with('pulang')->get();
    }

    public function render()
    {
        return view('livewire.admin.data-absen');
    }

    public function showData()
    {
        $tanggal = explode(' ', $this->tanggal);

        if (count($tanggal) == 1) {
            $this->absens = Absen::where('tanggal_absen', date('Y-m-d', strtotime($tanggal[0])))->orderby('tanggal_absen', 'asc')->with('karyawan')->with('datang')->with('is_keluar')->with('is_masuk')->with('pulang')->get();
        } else {

            $tanggalAwal = date('Y-m-d', strtotime($tanggal[0]));
            $tanggalAkhir = date('Y-m-d', strtotime($tanggal[2]));

            $this->absens = Absen::whereBetween('tanggal_absen', [$tanggalAwal, $tanggalAkhir])->orderby('tanggal_absen', 'asc')->with('karyawan')->with('datang')->with('is_keluar')->with('is_masuk')->with('pulang')->get();
        }

        $this->dispatchBrowserEvent('triggerJs');
    }

    public function deleteData()
    {
        error_reporting(0);

        // ambil foto dan hapus
        foreach ($this->absens as $absen) {
            $foto_datang[] = $absen->datang->foto_datang;
            $foto_pulang[] = $absen->pulang->foto_pulang;
        }

        for ($i = 0; $i < count($foto_datang); $i++) {
            unlink('storage/foto_datang/' . $foto_datang[$i]);
        }
        for ($i = 0; $i < count($foto_pulang); $i++) {
            unlink('storage/foto_pulang/' . $foto_pulang[$i]);
        }


        $tanggal = explode(' ', $this->tanggal);

        if (count($tanggal) == 1) {
            Absen::where('tanggal_absen', date('Y-m-d', strtotime($tanggal[0])))->delete();
            Datang::where('tanggal_datang', date('Y-m-d', strtotime($tanggal[0])))->delete();
            IsKeluar::where('tanggal_is_keluar', date('Y-m-d', strtotime($tanggal[0])))->delete();
            IsMasuk::where('tanggal_is_masuk', date('Y-m-d', strtotime($tanggal[0])))->delete();
            Pulang::where('tanggal_pulang', date('Y-m-d', strtotime($tanggal[0])))->delete();
        } else {

            $tanggalAwal = date('Y-m-d', strtotime($tanggal[0]));
            $tanggalAkhir = date('Y-m-d', strtotime($tanggal[2]));

            Absen::whereBetween('tanggal_absen', [$tanggalAwal, $tanggalAkhir])->delete();
            Datang::whereBetween('tanggal_datang', [$tanggalAwal, $tanggalAkhir])->delete();
            IsKeluar::whereBetween('tanggal_is_keluar', [$tanggalAwal, $tanggalAkhir])->delete();
            IsMasuk::whereBetween('tanggal_is_masuk', [$tanggalAwal, $tanggalAkhir])->delete();
            Pulang::whereBetween('tanggal_pulang', [$tanggalAwal, $tanggalAkhir])->delete();
        }

        $this->showData();
        $this->dispatchBrowserEvent('triggerJs');
    }
}
