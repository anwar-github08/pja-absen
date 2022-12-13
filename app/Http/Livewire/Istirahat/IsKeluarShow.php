<?php

namespace App\Http\Livewire\Istirahat;

use App\Models\IsKeluar;
use Livewire\Component;

class IsKeluarShow extends Component
{
    public $isKeluars;

    public function render()
    {
        $this->isKeluars = IsKeluar::with('karyawan')->where('tanggal_is_keluar', date('Y-m-d'))->orderBy('jam_is_keluar', 'desc')->get();
        return view('livewire.istirahat.is-keluar-show');
    }

    protected $listeners = ['eTriggerIsKeluarShow'];
    public function eTriggerIsKeluarShow()
    {
        // session()->flash('sukses', 'Berhasil Absen!!');
    }
}
