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
            $this->kunjungans = Kunjungan::where('tanggal_kunjungan', date('Y-m-d', strtotime($tanggal[0])))->with('karyawan')->get();
        } else {

            $tanggalAwal = date('Y-m-d', strtotime($tanggal[0]));
            $tanggalAkhir = date('Y-m-d', strtotime($tanggal[2]));

            $this->kunjungans = Kunjungan::whereBetween('tanggal_kunjungan', [$tanggalAwal, $tanggalAkhir])->orderby('tanggal_kunjungan', 'desc')->with('karyawan')->get();
        }

        $this->dispatchBrowserEvent('triggerJs');
    }
}
