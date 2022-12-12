<?php

namespace App\Http\Livewire\Datang;

use App\Http\Controllers\LokasiController;
use App\Models\Absen;
use App\Models\Datang;
use Livewire\Component;
use Livewire\WithFileUploads;

date_default_timezone_set('Asia/Bangkok');

class DatangCreate extends Component
{
    use WithFileUploads;

    public $karyawan_id;
    public $tanggal_datang;
    public $jam_datang;
    public $lokasi_datang;
    public $foto_datang;

    public $isAbsen = false;

    // public $karyawans;
    // public $iteration = 0;

    public function mount()
    {
        $lokasi = new LokasiController;
        $lokasi = $lokasi->index();

        $this->tanggal_datang = date('d-m-Y');
        $this->jam_datang = date('H:i:s');
        $this->lokasi_datang = $lokasi;
        $this->karyawan_id =  auth()->user()->karyawan_id;
    }

    public function render()
    {
        // jika sudah absen, isAbsen true
        $datang = Datang::select('id')->where('tanggal_datang', date('Y-m-d'))->where('karyawan_id', $this->karyawan_id)->first();
        if ($datang !== null) {

            $this->isAbsen = true;
        }

        // // ambil id_karyawan semua
        // $karyawan_id = Karyawan::select('id')->get();
        // foreach ($karyawan_id as $id) {

        //     $karyawan_id_array[] = $id->id;
        // }

        // // ambil id_karyawan yang sudah ada di tabel datang pada tanggal sekarang
        // $karyawan_id_dipakai = Datang::select('karyawan_id')->where('tanggal_datang', date('Y-m-d'))->get();
        // foreach ($karyawan_id_dipakai as $key) {
        //     $karyawan_id_dipakai_array[] = $key->karyawan_id;
        // }

        // // jika belum ada absen notyet = id karyawan
        // if (empty($karyawan_id_dipakai_array)) {
        //     $this->karyawans = Karyawan::orderBy('nama_karyawan', 'asc')->get();
        // } else {
        //     $notYetId = array_diff($karyawan_id_array, $karyawan_id_dipakai_array);
        //     $this->karyawans = Karyawan::whereIn('id', $notYetId)->orderBy('nama_karyawan', 'asc')->get();
        // }



        return view('livewire.datang.datang-create');
    }

    // menangkap emit
    // protected $listeners = ['refresh' => '$refresh'];

    // real time validation


    protected $rules = ['foto_datang' => 'image'];
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function storeDatang()
    {
        // validasi
        $this->validate([
            'foto_datang' => 'image'
        ]);

        // buat nama foto
        $imgName = date('dmyhis') . $this->karyawan_id . '.' . $this->foto_datang->extension();

        // simpan foto di direktori
        $this->foto_datang->storeAs('foto_datang', $imgName, 'public');

        // simpan di db
        $datang = Datang::create([

            'karyawan_id' => $this->karyawan_id,
            'tanggal_datang' => date('Y-m-d', strtotime($this->tanggal_datang)),
            'jam_datang' => $this->jam_datang,
            'lokasi_datang' => $this->lokasi_datang,
            'foto_datang' => $imgName
        ]);

        // simpan atau update absen
        Absen::updateOrInsert(
            [
                'karyawan_id' => $this->karyawan_id, 'tanggal_absen' => date('Y-m-d', strtotime($this->tanggal_datang))
            ],
            ['datang_id' => $datang->id, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]
        );


        // buat emit untuk trigger datang-show
        $this->emit('eTriggerDatangShow');
        // untuk trigger js
        $this->dispatchBrowserEvent('triggerJs');

        // iteration untuk trigger select2
        // $this->iteration++;
        $this->foto_datang = null;
    }
}
