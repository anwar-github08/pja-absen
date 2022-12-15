<?php

namespace App\Http\Livewire\Admin\JamKerja;

use App\Models\JamKerja;
use Livewire\Component;

class JamKerjaCreate extends Component
{
    public $nama_jam_kerja = '';
    public $jam_datang = '';
    public $jam_is_keluar = '';
    public $jam_is_masuk = '';
    public $jam_pulang = '';

    public $jam_sebelum_datang = '';
    public $jam_setelah_datang = '';
    public $jam_sebelum_istirahat = '';
    public $jam_setelah_istirahat = '';
    public $jam_sebelum_pulang = '';
    public $jam_setelah_pulang = '';

    public function render()
    {
        return view('livewire.admin.jam-kerja.jam-kerja-create');
    }

    public function storeJamKerja()
    {
        // dd($this->nama_jam_kerja, $this->jam_datang, $this->jam_is_keluar, $this->jam_is_masuk, $this->jam_pulang, $this->jam_sebelum_datang, $this->jam_sebelum_istirahat, $this->jam_sebelum_pulang, $this->jam_setelah_datang, $this->jam_setelah_istirahat, $this->jam_setelah_pulang);

        JamKerja::create([
            'nama_jam_kerja' => ucwords($this->nama_jam_kerja),
            'jam_datang' => $this->jam_datang,
            'jam_is_keluar' => $this->jam_is_keluar,
            'jam_is_masuk' => $this->jam_is_masuk,
            'jam_pulang' => $this->jam_pulang,
            'jam_sebelum_datang' => $this->jam_sebelum_datang,
            'jam_setelah_datang' => $this->jam_setelah_datang,
            'jam_sebelum_istirahat' => $this->jam_sebelum_istirahat,
            'jam_setelah_istirahat' => $this->jam_setelah_istirahat,
            'jam_sebelum_pulang' => $this->jam_sebelum_pulang,
            'jam_setelah_pulang' => $this->jam_setelah_pulang,
        ]);

        // buat emit untuk trigger show
        $this->emit('eTriggerJamKerjaShow');
        $this->dispatchBrowserEvent('triggerJs');

        $this->nama_jam_kerja = '';
        $this->jam_datang = '';
        $this->jam_is_keluar = '';
        $this->jam_is_masuk = '';
        $this->jam_pulang = '';

        $this->jam_sebelum_datang = '';
        $this->jam_setelah_datang = '';
        $this->jam_sebelum_istirahat = '';
        $this->jam_setelah_istirahat = '';
        $this->jam_sebelum_pulang = '';
        $this->jam_setelah_pulang = '';
    }
}
