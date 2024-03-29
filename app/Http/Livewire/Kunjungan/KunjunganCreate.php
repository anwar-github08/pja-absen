<?php

namespace App\Http\Livewire\Kunjungan;

use Livewire\Component;
use App\Models\Kunjungan;
use Livewire\WithFileUploads;
use App\Http\Controllers\LokasiController;
use Intervention\Image\ImageManagerStatic as Image;

date_default_timezone_set('Asia/Bangkok');
class KunjunganCreate extends Component
{
    use WithFileUploads;

    public $karyawan_id;
    public $tanggal_kunjungan;
    public $jam_kunjungan;
    public $lokasi_kunjungan;
    public $foto_kunjungan;

    // public $isAbsen = false;

    public function mount()
    {
        $lokasi = new LokasiController;
        $lokasi = $lokasi->index();

        $this->tanggal_kunjungan = date('d-m-Y');
        $this->jam_kunjungan = date('H:i:s');
        $this->lokasi_kunjungan = $lokasi;
        $this->karyawan_id =  auth()->user()->karyawan_id;
    }


    public function render()
    {
        // jika sudah absen, isAbsen true
        // $kunjungan = Kunjungan::select('id')->where('tanggal_kunjungan', date('Y-m-d'))->where('karyawan_id', $this->karyawan_id)->first();
        // if ($kunjungan !== null) {

        //     $this->isAbsen = true;
        // }

        return view('livewire.kunjungan.kunjungan-create');
    }

    // menangkap emit
    protected $listeners = ['getLocation'];

    public function getLocation($latLang)
    {
        $this->lokasi_kunjungan = $latLang;
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
        // $this->foto_kunjungan->storeAs('foto_kunjungan', $imgName, 'public');

        // proses compress image dan simpan
        $img = Image::make($this->foto_kunjungan->path())->resize(500, 500);
        $img->save('F:\laravel\pja-absen\public\storage\foto_kunjungan/' . $imgName, 60);

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
