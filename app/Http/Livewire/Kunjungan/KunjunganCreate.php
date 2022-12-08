<?php

namespace App\Http\Livewire\Kunjungan;

use Livewire\Component;
use App\Models\Karyawan;
use App\Models\Kunjungan;
use Livewire\WithFileUploads;

date_default_timezone_set('Asia/Bangkok');
class KunjunganCreate extends Component
{
    use WithFileUploads;

    public $karyawan_id;
    public $tanggal_kunjungan;
    public $jam_kunjungan;
    public $lokasi_kunjungan;
    public $foto_kunjungan;

    public function mount()
    {
        $this->tanggal_kunjungan = date('d-m-Y');
        $this->jam_kunjungan = date('H:i:s');
        $this->lokasi_kunjungan = '-235252, 23235';
        $this->karyawan_id =  auth()->user()->karyawan_id;
    }


    public function render()
    {
        return view('livewire.kunjungan.kunjungan-create');
    }


    protected $rules = ['foto_kunjungan' => 'image'];
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function storeKunjungan()
    {
        // validasi
        $this->validate([
            'foto_kunjungan' => 'image'
        ]);

        // buat nama foto
        $imgName = date('dmyhis') . $this->karyawan_id . '.' . $this->foto_kunjungan->extension();

        // simpan foto di direktori
        $this->foto_kunjungan->storeAs('foto_kunjungan', $imgName, 'public');

        // simpan di db
        Kunjungan::create([

            'karyawan_id' => $this->karyawan_id,
            'tanggal_kunjungan' => date('Y-m-d', strtotime($this->tanggal_kunjungan)),
            'jam_kunjungan' => $this->jam_kunjungan,
            'lokasi_kunjungan' => $this->lokasi_kunjungan,
            'foto_kunjungan' => $imgName
        ]);


        // buat emit untuk trigger kunjungan-show
        $this->emit('eTriggerKunjunganShow');
        $this->dispatchBrowserEvent('triggerJs');

        $this->foto_kunjungan = null;
    }
}
