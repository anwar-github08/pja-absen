<?php

namespace App\Http\Livewire\Kunjungan;

use App\Models\Kunjungan;
use Livewire\Component;

class KunjunganShow extends Component
{
    public $kunjungans;

    public function render()
    {
        $this->kunjungans = Kunjungan::with('karyawan')->where('tanggal_kunjungan', date('Y-m-d'))->orderBy('jam_kunjungan', 'desc')->get();

        return view('livewire.kunjungan.kunjungan-show');
    }

    // menangkap emit
    protected $listeners = ['eTriggerKunjunganShow'];

    public function eTriggerKunjunganShow()
    {
        session()->flash('sukses', 'Berhasil Absen!!');
    }
}
