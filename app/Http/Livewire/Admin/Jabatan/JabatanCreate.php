<?php

namespace App\Http\Livewire\Admin\Jabatan;

use App\Models\Jabatan;
use Livewire\Component;

class JabatanCreate extends Component
{
    public $nama_jabatan;

    public function render()
    {
        return view('livewire.admin.jabatan.jabatan-create');
    }

    public function storeJabatan()
    {

        Jabatan::create([

            'nama_jabatan' => ucwords($this->nama_jabatan),
        ]);

        // buat emit untuk trigger jabatan-show
        $this->emit('eTriggerJabatanShow');
        $this->dispatchBrowserEvent('triggerJs');

        $this->nama_jabatan = '';
    }
}
