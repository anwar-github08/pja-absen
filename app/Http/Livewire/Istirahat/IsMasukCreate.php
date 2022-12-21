<?php

namespace App\Http\Livewire\Istirahat;

use App\Models\Absen;
use App\Models\IsMasuk;
use Livewire\Component;
use App\Models\Karyawan;
use App\Http\Controllers\LokasiController;

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
        $lokasi = new LokasiController;
        $lokasi = $lokasi->index();

        $this->tanggal_is_masuk = date('d-m-Y');
        $this->jam_is_masuk = date('H:i:s');
        $this->lokasi_is_masuk = $lokasi;
        $this->karyawan_id =  auth()->user()->karyawan_id;

        $jam_kerja_id = Karyawan::select('jam_kerja_id')->where('id', auth()->user()->karyawan_id)->first();
        $this->jam_kerja_id = $jam_kerja_id->jam_kerja_id;
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

    // menangkap emit
    protected $listeners = ['getLocation'];

    public function getLocation($latLang)
    {
        $this->lokasi_is_masuk = $latLang;
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
                'karyawan_id' => $this->karyawan_id, 'jam_kerja_id' => $this->jam_kerja_id, 'tanggal_absen' => date('Y-m-d', strtotime($this->tanggal_is_masuk))
            ],
            ['is_masuk_id' => $isMasuk->id, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]
        );


        $this->emit('eTriggerIsMasukShow');
        $this->dispatchBrowserEvent('triggerJs');
    }
}
