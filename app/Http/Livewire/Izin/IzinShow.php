<?php

namespace App\Http\Livewire\Izin;

use App\Models\Izin;
use Livewire\Component;

class IzinShow extends Component
{

    public $izins;
    public function render()
    {
        $this->izins = Izin::with('karyawan')->where('tanggal_izin', date('Y-m-d'))->orderBy('jam_izin', 'desc')->get();
        return view('livewire.izin.izin-show');
    }

    protected $listeners = ['eTriggerIzinShow'];
    public function eTriggerIzinShow()
    {

        session()->flash('sukses', 'Berhasil Izin!!');
    }
}
