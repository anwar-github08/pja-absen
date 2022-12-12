<?php

namespace App\Http\Livewire\Izin;

use App\Models\Izin;
use App\Models\Absen;
use Livewire\Component;
use App\Http\Controllers\LokasiController;

date_default_timezone_set('Asia/Bangkok');

class IzinCreate extends Component
{
    public $karyawan_id;
    public $tanggal_izin;
    public $jam_izin;
    public $lokasi_izin;
    public $keperluan = '';

    // public $isAbsen = false;

    public function mount()
    {
        $lokasi = new LokasiController;
        $lokasi = $lokasi->index();

        $this->tanggal_izin = date('d-m-Y');
        $this->jam_izin = date('H:i:s');
        $this->lokasi_izin = $lokasi;
        $this->karyawan_id =  auth()->user()->karyawan_id;
    }

    public function render()
    {
        // jika sudah absen, isAbsen true
        // $izin = Izin::select('id')->where('tanggal_izin', date('Y-m-d'))->where('karyawan_id', $this->karyawan_id)->first();
        // if ($izin !== null) {

        //     $this->isAbsen = true;
        // }

        return view('livewire.izin.izin-create');
    }

    public function storeIzin()
    {

        $izin = Izin::create([

            'karyawan_id' => $this->karyawan_id,
            'tanggal_izin' => date('Y-m-d', strtotime($this->tanggal_izin)),
            'jam_izin' => $this->jam_izin,
            'lokasi_izin' => $this->lokasi_izin,
            'keperluan' => ucwords($this->keperluan)
        ]);

        // simpan atau update absen
        Absen::updateOrInsert(
            [
                'karyawan_id' => $this->karyawan_id, 'tanggal_absen' => date('Y-m-d', strtotime($this->tanggal_izin))
            ],
            ['izin_id' => $izin->id, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]
        );

        $this->emit('eTriggerIzinShow');
        $this->dispatchBrowserEvent('triggerJs');

        $this->keperluan = '';
    }
}
