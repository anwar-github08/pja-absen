<?php

namespace App\Http\Livewire\Admin;

use App\Models\Absen;
use Livewire\Component;

class DataAbsen extends Component
{
    public $absens;
    public $tanggal = '';

    public function mount()
    {
        $this->absens = Absen::where('tanggal_absen', date('Y-m-d'))->with('karyawan')->with('datang')->with('is_keluar')->with('is_masuk')->with('pulang')->with('izin')->get();
    }

    public function render()
    {
        return view('livewire.admin.data-absen');
    }

    public function showData()
    {
        $tanggal = explode(' ', $this->tanggal);

        if (count($tanggal) == 1) {
            $this->absens = Absen::where('tanggal_absen', date('Y-m-d', strtotime($tanggal[0])))->with('karyawan')->with('datang')->with('is_keluar')->with('is_masuk')->with('pulang')->with('izin')->get();
        } else {

            $tanggalAwal = date('Y-m-d', strtotime($tanggal[0]));
            $tanggalAkhir = date('Y-m-d', strtotime($tanggal[2]));

            $this->absens = Absen::whereBetween('tanggal_absen', [$tanggalAwal, $tanggalAkhir])->with('karyawan')->with('datang')->with('is_keluar')->with('is_masuk')->with('pulang')->with('izin')->get();
        }
    }
}
