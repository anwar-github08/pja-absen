<?php

namespace App\Http\Livewire\Admin;

use App\Models\Absen;
use Livewire\Component;

class DataAbsen extends Component
{
    public $absens;

    public function render()
    {
        $this->absens = Absen::with('karyawan')->with('datang')->with('is_keluar')->with('is_masuk')->with('pulang')->with('izin')->get();
        return view('livewire.admin.data-absen');
    }
}
