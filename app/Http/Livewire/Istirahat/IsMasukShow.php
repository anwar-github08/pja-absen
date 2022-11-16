<?php

namespace App\Http\Livewire\Istirahat;

use App\Models\IsMasuk;
use Livewire\Component;

class IsMasukShow extends Component
{
    public $isMasuks;
    public function render()
    {
        $this->isMasuks = IsMasuk::with('karyawan')->where('tanggal_is_masuk', date('Y-m-d'))->orderBy('jam_is_masuk', 'desc')->get();
        return view('livewire.istirahat.is-masuk-show');
    }

    protected $listeners = ['eTriggerIsMasukShow'];
    public function eTriggerIsMasukShow()
    {

        session()->flash('sukses', 'Berhasil Absen!!');
    }
}
