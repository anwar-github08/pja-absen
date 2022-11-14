<?php

namespace App\Http\Livewire\Datang;

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

    public $img;

    public $karyawans;

    public function render()
    {
        $this->tanggal_datang = date('d-m-Y');
        $this->jam_datang = date('H:i:s');
        $this->lokasi_datang = '-235252, 23235';
        $this->karyawans = Karyawan::orderBy('nama_karyawan', 'asc')->get();

        return view('livewire.datang.datang-create');
    }

    public function storeDatang()
    {
        dd($this->img);
    }
}
