<?php

namespace App\Http\Livewire\Istirahat;

use App\Models\Absen;
use App\Models\IsMasuk;
use Livewire\Component;
use App\Models\Karyawan;

date_default_timezone_set('Asia/Bangkok');

class IsMasukCreate extends Component
{
    public $karyawan_id;
    public $tanggal_is_masuk;
    public $jam_is_masuk;
    public $lokasi_is_masuk;

    public $isAbsen = false;

    public function mount()
    {
        $this->tanggal_is_masuk = date('d-m-Y');
        $this->jam_is_masuk = date('H:i:s');
        $this->lokasi_is_masuk = '-235252, 23235';
        $this->karyawan_id =  auth()->user()->karyawan_id;
    }

    public function render()
    {
        // jika sudah absen, isAbsen true
        $isMasuk = IsMasuk::select('id')->where('tanggal_is_masuk', date('Y-m-d'))->where('karyawan_id', $this->karyawan_id)->first();
        if ($isMasuk !== null) {

            $this->isAbsen = true;
        }

        return view('livewire.istirahat.is-masuk-create');
    }


    public function storeIsMasuk()
    {

        // langsung simpan di db
        $isMasuk = IsMasuk::create([

            'karyawan_id' => $this->karyawan_id,
            'tanggal_is_masuk' => date('Y-m-d', strtotime($this->tanggal_is_masuk)),
            'jam_is_masuk' => $this->jam_is_masuk,
            'lokasi_is_masuk' => $this->lokasi_is_masuk
        ]);

        // simpan atau update absen
        Absen::updateOrInsert(
            [
                'karyawan_id' => $this->karyawan_id, 'tanggal_absen' => date('Y-m-d', strtotime($this->tanggal_is_masuk))
            ],
            ['is_masuk_id' => $isMasuk->id, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]
        );


        $this->emit('eTriggerIsMasukShow');
        $this->dispatchBrowserEvent('triggerJs');
    }
}
