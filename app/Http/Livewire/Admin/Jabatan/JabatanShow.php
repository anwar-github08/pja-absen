<?php

namespace App\Http\Livewire\Admin\Jabatan;

use App\Models\Jabatan;
use Livewire\Component;

class JabatanShow extends Component
{
    public $jabatans;

    public function render()
    {
        $this->jabatans = Jabatan::orderby('nama_jabatan', 'asc')->get();

        return view('livewire.admin.jabatan.jabatan-show');
    }

    // menangkap emit
    protected $listeners = ['eTriggerJabatanShow'];

    public function eTriggerJabatanShow()
    {
        session()->flash('sukses', 'Data Tersimpan');
    }

    public function deleteJabatan($id)
    {
        Jabatan::destroy($id);
    }
}
