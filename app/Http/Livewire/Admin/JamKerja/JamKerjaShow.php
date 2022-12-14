<?php

namespace App\Http\Livewire\Admin\JamKerja;

use App\Models\JamKerja;
use Livewire\Component;

class JamKerjaShow extends Component
{

    public $jam_kerjas;

    public function render()
    {
        $this->jam_kerjas = JamKerja::orderby('nama_jam_kerja', 'asc')->get();

        return view('livewire.admin.jam-kerja.jam-kerja-show');
    }

    // menangkap emit
    protected $listeners = ['eTriggerJamKerjaShow'];

    public function eTriggerJamKerjaShow()
    {
        session()->flash('sukses', 'Data Tersimpan');
    }
}
