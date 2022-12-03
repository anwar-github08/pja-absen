<?php

namespace App\Http\Livewire\Admin\Karyawan;

use App\Models\Izin;
use App\Models\Absen;
use App\Models\Datang;
use App\Models\Pulang;
use App\Models\IsMasuk;
use Livewire\Component;
use App\Models\IsKeluar;
use App\Models\Karyawan;
use App\Models\Kunjungan;

class KaryawanShow extends Component
{

    public $karyawans;

    public function render()
    {
        $this->karyawans = Karyawan::with('jabatan')->orderby('nama_karyawan', 'asc')->get();

        return view('livewire.admin.karyawan.karyawan-show');
    }

    // menangkap emit
    protected $listeners = ['eTriggerKaryawanShow'];

    public function eTriggerKaryawanShow()
    {
        session()->flash('sukses', 'Data Tersimpan');
    }

    public function deleteKaryawan($id)
    {
        Karyawan::destroy($id);

        Datang::where('karyawan_id', $id)->delete();
        IsKeluar::where('karyawan_id', $id)->delete();
        IsMasuk::where('karyawan_id', $id)->delete();
        Pulang::where('karyawan_id', $id)->delete();
        Izin::where('karyawan_id', $id)->delete();
        Kunjungan::where('karyawan_id', $id)->delete();
        Absen::where('karyawan_id', $id)->delete();
    }
}
