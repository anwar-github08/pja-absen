<?php

namespace App\Http\Livewire\Admin\Karyawan;

use App\Models\Jabatan;
use App\Models\Karyawan;
use Livewire\Component;

class KaryawanCreate extends Component
{

    public $nama_karyawan = '';
    public $jabatan_id = '-';

    public $jabatans;

    public function render()
    {
        $this->jabatans = Jabatan::orderBy('nama_jabatan', 'asc')->get();

        return view('livewire.admin.karyawan.karyawan-create');
    }

    public function storeKaryawan()
    {

        Karyawan::create([

            'nama_karyawan' => ucwords($this->nama_karyawan),
            'jabatan_id' => $this->jabatan_id
        ]);

        // buat emit untuk trigger karyawan-show
        $this->emit('eTriggerKaryawanShow');

        $this->nama_karyawan = '';
        $this->jabatan_id = '-';
    }
}
