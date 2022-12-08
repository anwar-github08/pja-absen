<?php

namespace App\Http\Livewire\Admin\Jabatan;

use App\Models\Absen;
use App\Models\Datang;
use App\Models\IsKeluar;
use App\Models\IsMasuk;
use App\Models\Izin;
use App\Models\Jabatan;
use App\Models\JabatanKunjungan;
use App\Models\Karyawan;
use App\Models\Kunjungan;
use App\Models\Pulang;
use App\Models\User;
use Livewire\Component;

class JabatanShow extends Component
{
    public $jabatans;

    public function render()
    {
        $this->jabatans = Jabatan::orderby('nama_jabatan', 'asc')->get();

        return view('livewire.admin.jabatan.jabatan-show');
    }

    // menangkap emit
    protected $listeners = ['eTriggerJabatanShow'];

    public function eTriggerJabatanShow()
    {
        session()->flash('sukses', 'Data Tersimpan');
    }

    public function deleteJabatan($id)
    {
        $id_karyawan = Karyawan::select('id')->where('jabatan_id', $id)->first();

        Jabatan::destroy($id);
        JabatanKunjungan::where('jabatan_id', $id)->delete();
        Karyawan::where('jabatan_id', $id)->delete();
        User::where('jabatan_id', $id)->delete();

        // jika ada karyawan
        if ($id_karyawan !== null) {
            Datang::where('karyawan_id', $id_karyawan->id)->delete();
            IsKeluar::where('karyawan_id', $id_karyawan->id)->delete();
            IsMasuk::where('karyawan_id', $id_karyawan->id)->delete();
            Pulang::where('karyawan_id', $id_karyawan->id)->delete();
            Izin::where('karyawan_id', $id_karyawan->id)->delete();
            Kunjungan::where('karyawan_id', $id_karyawan->id)->delete();
            Absen::where('karyawan_id', $id_karyawan->id)->delete();
        }

        $this->dispatchBrowserEvent('triggerJs');
    }
}
