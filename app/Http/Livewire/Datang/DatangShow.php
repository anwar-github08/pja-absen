<?php

namespace App\Http\Livewire\Datang;

use App\Models\Datang;
use Livewire\Component;

class DatangShow extends Component
{

    public $datangs;

    public function render()
    {
        $this->datangs = Datang::with('karyawan')->where('tanggal_datang', date('Y-m-d'))->orderBy('jam_datang', 'desc')->get();

        return view('livewire.datang.datang-show');
    }

    // menangkap emit
    protected $listeners = ['eTriggerDatangShow'];

    public function eTriggerDatangShow()
    {
        session()->flash('sukses', 'Berhasil Absen!!');
    }
}
