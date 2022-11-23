<?php

namespace App\Http\Livewire\Admin\Karyawan;

use App\Models\Karyawan;
use Livewire\Component;

class KaryawanCreate extends Component
{

    public $nama_karyawan = '';
    public $jabatan = '-';

    public function render()
    {
        return view('livewire.admin.karyawan.karyawan-create');
    }

    public function storeKaryawan()
    {

        Karyawan::create([

            'nama_karyawan' => ucwords($this->nama_karyawan),
            'jabatan' => $this->jabatan
        ]);

        // buat emit untuk trigger karyawan-show
        $this->emit('eTriggerKaryawanShow');

        $this->nama_karyawan = '';
        $this->jabatan = '-';
    }
}
