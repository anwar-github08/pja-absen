<?php

namespace App\Http\Livewire\Datang;

use App\Models\Datang;
use App\Models\Karyawan;
use Livewire\Component;
use Livewire\WithFileUploads;

date_default_timezone_set('Asia/Bangkok');

class DatangCreate extends Component
{
    use WithFileUploads;

    public $karyawan_id = '-';
    public $tanggal_datang;
    public $jam_datang;
    public $lokasi_datang;
    public $foto_datang;

    public $karyawans;

    public function render()
    {
        $this->tanggal_datang = date('d-m-Y');
        $this->jam_datang = date('H:i:s');
        $this->lokasi_datang = '-235252, 23235';

        // ambil id_karyawan semua
        $karyawan_id = Karyawan::select('id')->get();
        foreach ($karyawan_id as $id) {

            $karyawan_id_array[] = $id->id;
        }

        // ambil id_karyawan yang sudah ada di tabel datang pada tanggal sekarang
        $karyawan_id_dipakai = Datang::select('karyawan_id')->where('tanggal_datang', date('Y-m-d'))->get();
        foreach ($karyawan_id_dipakai as $key) {
            $karyawan_id_dipakai_array[] = $key->karyawan_id;
        }

        // jika belum ada absen notyet = id karyawan
        if (empty($karyawan_id_dipakai_array)) {
            $this->karyawans = Karyawan::orderBy('nama_karyawan', 'asc')->get();
        } else {
            $notYetId = array_diff($karyawan_id_array, $karyawan_id_dipakai_array);
            $this->karyawans = Karyawan::whereIn('id', $notYetId)->orderBy('nama_karyawan', 'asc')->get();
        }



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
        Datang::create([

            'karyawan_id' => $this->karyawan_id,
            'tanggal_datang' => date('Y-m-d', strtotime($this->tanggal_datang)),
            'jam_datang' => $this->jam_datang,
            'lokasi_datang' => $this->lokasi_datang,
            'foto_datang' => $imgName
        ]);

        // buat emit untuk trigger datang-show
        $this->emit('eTriggerDatangShow');

        $this->karyawan_id = '-';
        $this->foto_datang = null;
    }
}
