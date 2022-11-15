<?php

namespace App\Http\Livewire\Pulang;

use App\Models\Pulang;
use Livewire\Component;

class PulangShow extends Component
{

    public $pulangs;
    public function render()
    {
        $this->pulangs = Pulang::with('karyawan')->where('tanggal_pulang', date('Y-m-d'))->orderBy('jam_pulang', 'desc')->get();

        return view('livewire.pulang.pulang-show');
    }

    // menangkap emit
    protected $listeners = ['eTriggerPulangShow'];

    public function eTriggerPulangShow()
    {
        session()->flash('sukses', 'Berhasil Absen!!');
    }
}
