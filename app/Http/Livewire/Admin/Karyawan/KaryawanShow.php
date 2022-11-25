<?php

namespace App\Http\Livewire\Admin\Karyawan;

use App\Models\Karyawan;
use Livewire\Component;

class KaryawanShow extends Component
{

    public $karyawans;

    public function render()
    {
        $this->karyawans = Karyawan::with('jabatan')->orderby('nama_karyawan', 'asc')->get();

        return view('livewire.admin.karyawan.karyawan-show');
    }

    // menangkap emit
    protected $listeners = ['eTriggerKaryawanShow'];

    public function eTriggerKaryawanShow()
    {
        session()->flash('sukses', 'Data Tersimpan');
    }

    public function deleteKaryawan($id)
    {
        Karyawan::destroy($id);
    }
}
