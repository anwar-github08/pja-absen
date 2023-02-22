<?php

namespace App\Http\Livewire\Pulang;

use App\Models\Absen;
use App\Models\Pulang;
use Livewire\Component;
use App\Models\Karyawan;
use Livewire\WithFileUploads;
use App\Http\Controllers\LokasiController;
use Intervention\Image\ImageManagerStatic as Image;

date_default_timezone_set('Asia/Bangkok');

class PulangCreate extends Component
{

    use WithFileUploads;

    public $karyawan_id = '-';
    public $tanggal_pulang;
    public $jam_pulang;
    public $lokasi_pulang;
    public $foto_pulang;

    public $jam_kerja_id;

    public $isAbsen = false;

    public function mount()
    {
        $lokasi = new LokasiController;
        $lokasi = $lokasi->index();

        $this->tanggal_pulang = date('d-m-Y');
        $this->jam_pulang = date('H:i:s');
        $this->lokasi_pulang = $lokasi;
        $this->karyawan_id =  auth()->user()->karyawan_id;

        $jam_kerja_id = Karyawan::select('jam_kerja_id')->where('id', auth()->user()->karyawan_id)->first();
        $this->jam_kerja_id = $jam_kerja_id->jam_kerja_id;
    }

    public function render()
    {
        // jika sudah absen, isAbsen true
        $pulang = Pulang::select('id')->where('tanggal_pulang', date('Y-m-d'))->where('karyawan_id', $this->karyawan_id)->first();
        if ($pulang !== null) {

            $this->isAbsen = true;
        }

        return view('livewire.pulang.pulang-create');
    }

    // menangkap emit
    protected $listeners = ['getLocation'];

    public function getLocation($latLang)
    {
        $this->lokasi_pulang = $latLang;
    }

    // real time validation
    protected $rules = ['foto_pulang' => 'image'];
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function storePulang()
    {

        // validasi
        $this->validate([
            'foto_pulang' => 'image'
        ]);

        // buat nama foto
        $imgName = date('dmyhis') . $this->karyawan_id . '.' . $this->foto_pulang->extension();

        // simpan foto di direktori
        // $this->foto_pulang->storeAs('foto_pulang', $imgName, 'public');

        // proses compress image dan simpan
        $img = Image::make($this->foto_pulang->path())->resize(500, 500);
        $img->save('F:\laravel\pja-absen\public\storage\foto_pulang/' . $imgName, 60);

        // simpan di db
        $pulang = Pulang::create([

            'karyawan_id' => $this->karyawan_id,
            'tanggal_pulang' => date('Y-m-d', strtotime($this->tanggal_pulang)),
            'jam_pulang' => $this->jam_pulang,
            'lokasi_pulang' => $this->lokasi_pulang,
            'foto_pulang' => $imgName
        ]);


        // simpan atau update absen
        Absen::updateOrInsert(
            [
                'karyawan_id' => $this->karyawan_id, 'jam_kerja_id' => $this->jam_kerja_id, 'tanggal_absen' => date('Y-m-d', strtotime($this->tanggal_pulang))
            ],
            ['pulang_id' => $pulang->id, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]
        );

        // buat emit untuk trigger pulang-show
        $this->emit('eTriggerPulangShow');
        $this->dispatchBrowserEvent('triggerJs');

        $this->foto_pulang = null;
    }
}
