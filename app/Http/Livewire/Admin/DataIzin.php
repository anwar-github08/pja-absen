<?php

namespace App\Http\Livewire\Admin;

use App\Models\Izin;
use Livewire\Component;

class DataIzin extends Component
{
    public $izins;
    public $tanggal = '';

    public function mount()
    {
        $this->tanggal = date('Y-m-d');
        $this->izins = Izin::where('tanggal_izin', date('Y-m-d'))->with('karyawan')->get();
    }

    public function render()
    {
        return view('livewire.admin.data-izin');
    }

    public function showData()
    {
        $tanggal = explode(' ', $this->tanggal);

        if (count($tanggal) == 1) {
            $this->izins = Izin::where('tanggal_izin', date('Y-m-d', strtotime($tanggal[0])))->with('karyawan')->get();
        } else {

            $tanggalAwal = date('Y-m-d', strtotime($tanggal[0]));
            $tanggalAkhir = date('Y-m-d', strtotime($tanggal[2]));

            $this->izins = Izin::whereBetween('tanggal_izin', [$tanggalAwal, $tanggalAkhir])->orderby('tanggal_izin', 'desc')->with('karyawan')->get();
        }

        $this->dispatchBrowserEvent('triggerJs');
    }

    public function deleteData()
    {

        error_reporting(0);

        $tanggal = explode(' ', $this->tanggal);

        if (count($tanggal) == 1) {
            Izin::where('tanggal_izin', date('Y-m-d', strtotime($tanggal[0])))->delete();
        } else {

            $tanggalAwal = date('Y-m-d', strtotime($tanggal[0]));
            $tanggalAkhir = date('Y-m-d', strtotime($tanggal[2]));

            Izin::whereBetween('tanggal_izin', [$tanggalAwal, $tanggalAkhir])->delete();
        }

        $this->showData();
        $this->dispatchBrowserEvent('triggerJs');
    }
}
