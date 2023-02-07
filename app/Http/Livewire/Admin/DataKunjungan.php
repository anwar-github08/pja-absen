<?php

namespace App\Http\Livewire\Admin;

use App\Models\Kunjungan;
use Livewire\Component;

class DataKunjungan extends Component
{
    public $kunjungans;
    public $tanggal = '';

    public function mount()
    {
        $this->tanggal = date('Y-m-d');
        $this->kunjungans = Kunjungan::where('tanggal_kunjungan', date('Y-m-d'))->with('karyawan')->get();
    }

    public function render()
    {
        return view('livewire.admin.data-kunjungan');
    }

    public function showData()
    {
        $tanggal = explode(' ', $this->tanggal);

        if (count($tanggal) == 1) {
            $this->kunjungans = Kunjungan::where('tanggal_kunjungan', date('Y-m-d', strtotime($tanggal[0])))->orderby('tanggal_kunjungan', 'asc')->with('karyawan')->get();
        } else {

            $tanggalAwal = date('Y-m-d', strtotime($tanggal[0]));
            $tanggalAkhir = date('Y-m-d', strtotime($tanggal[2]));

            $this->kunjungans = Kunjungan::whereBetween('tanggal_kunjungan', [$tanggalAwal, $tanggalAkhir])->orderby('tanggal_kunjungan', 'asc')->with('karyawan')->get();
        }

        $this->dispatchBrowserEvent('triggerJs');
    }

    public function deleteData()
    {

        error_reporting(0);

        // ambil foto dan hapus
        foreach ($this->kunjungans as $kunjungan) {
            $foto_kunjungan[] = $kunjungan->foto_kunjungan;
        }

        for ($i = 0; $i < count($foto_kunjungan); $i++) {
            unlink('storage/foto_kunjungan/' . $foto_kunjungan[$i]);
        }


        $tanggal = explode(' ', $this->tanggal);

        if (count($tanggal) == 1) {
            Kunjungan::where('tanggal_kunjungan', date('Y-m-d', strtotime($tanggal[0])))->delete();
        } else {

            $tanggalAwal = date('Y-m-d', strtotime($tanggal[0]));
            $tanggalAkhir = date('Y-m-d', strtotime($tanggal[2]));

            Kunjungan::whereBetween('tanggal_kunjungan', [$tanggalAwal, $tanggalAkhir])->delete();
        }

        $this->showData();
        $this->dispatchBrowserEvent('triggerJs');
    }
}
