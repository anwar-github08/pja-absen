<?php

namespace App\Http\Livewire\Istirahat;

use App\Models\Absen;
use Livewire\Component;
use App\Models\IsKeluar;
use App\Models\Karyawan;
use App\Http\Controllers\LokasiController;

date_default_timezone_set('Asia/Bangkok');

class IsKeluarCreate extends Component
{
    public $karyawan_id;
    public $tanggal_is_keluar;
    public $jam_is_keluar;
    public $lokasi_is_keluar;

    public $karyawans;
    public $isAbsen = false;

    public function mount()
    {
        $lokasi = new LokasiController;
        $lokasi = $lokasi->index();

        $this->tanggal_is_keluar = date('d-m-Y');
        $this->jam_is_keluar = date('H:i:s');
        $this->lokasi_is_keluar = $lokasi;
        $this->karyawan_id =  auth()->user()->karyawan_id;

        $jam_kerja_id = Karyawan::select('jam_kerja_id')->where('id', auth()->user()->karyawan_id)->first();
        $this->jam_kerja_id = $jam_kerja_id->jam_kerja_id;
    }

    public function render()
    {
        // jika sudah absen, isAbsen true
        $isKeluar = IsKeluar::select('id')->where('tanggal_is_keluar', date('Y-m-d'))->where('karyawan_id', $this->karyawan_id)->first();
        if ($isKeluar !== null) {

            $this->isAbsen = true;
        }

        return view('livewire.istirahat.is-keluar-create');
    }

    // menangkap emit
    protected $listeners = ['getLocation'];

    public function getLocation($latLang)
    {
        $this->lokasi_is_keluar = $latLang;
    }

    public function storeIsKeluar()
    {

        // langsung simpan di db
        $isKeluar = IsKeluar::create([

            'karyawan_id' => $this->karyawan_id,
            'tanggal_is_keluar' => date('Y-m-d', strtotime($this->tanggal_is_keluar)),
            'jam_is_keluar' => $this->jam_is_keluar,
            'lokasi_is_keluar' => $this->lokasi_is_keluar
        ]);

        // simpan atau update absen
        Absen::updateOrInsert(
            [
                'karyawan_id' => $this->karyawan_id, 'jam_kerja_id' => $this->jam_kerja_id, 'tanggal_absen' => date('Y-m-d', strtotime($this->tanggal_is_keluar))
            ],
            ['is_keluar_id' => $isKeluar->id, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]
        );

        $this->emit('eTriggerIsKeluarShow');
        $this->dispatchBrowserEvent('triggerJs');
    }
}
