<?php

namespace App\Http\Livewire\Admin;

use App\Models\Jabatan;
use App\Models\JabatanKunjungan;
use Livewire\Component;

class AksesKunjungan extends Component
{
    public $jabatans;

    public $jabatan_id = [];

    public function mount()
    {

        $jabatan_id = JabatanKunjungan::select('jabatan_id')->get();
        foreach ($jabatan_id as $id) {

            $jabatan_id_array[] = $id->jabatan_id;
        }
        if (!empty($jabatan_id_array)) {

            $this->jabatan_id = $jabatan_id_array;
        }
    }
    protected $listeners = ['refresh'];
    public function refresh()
    {
        session()->flash('sukses', 'Tersimpan!!');
    }

    public function render()
    {
        $this->jabatans = Jabatan::orderby('nama_jabatan', 'asc')->get();

        return view('livewire.admin.akses-kunjungan');
    }

    public function storeJabatanId()
    {
        JabatanKunjungan::truncate();

        for ($i = 0; $i < count($this->jabatan_id); $i++) {
            JabatanKunjungan::create(['jabatan_id' => $this->jabatan_id[$i]]);
        }

        $this->emitSelf('refresh');
    }
}
