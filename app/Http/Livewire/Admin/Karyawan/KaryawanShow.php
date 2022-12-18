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
use App\Models\User;

class KaryawanShow extends Component
{

    public $karyawans;

    public function render()
    {
        $this->karyawans = Karyawan::with('jabatan')->with('user')->with('jam_kerja')->orderby('nama_karyawan', 'asc')->get();
        return view('livewire.admin.karyawan.karyawan-show');
    }

    // menangkap emit
    protected $listeners = ['eTriggerKaryawanShow', 'refresh' => '$refresh'];

    public function eTriggerKaryawanShow()
    {
        session()->flash('sukses', 'Data Tersimpan');
    }

    public function changeIsAdmin($id_user, $value)
    {
        if ($value == 0) {
            $value = true;
        } else {
            $value = false;
        };

        User::where('id', $id_user)->update(['is_admin' => $value]);

        $this->emitSelf('refresh');
        $this->dispatchBrowserEvent('triggerJs');
    }

    public function deleteKaryawan($id)
    {
        Karyawan::destroy($id);

        User::where('karyawan_id', $id)->delete();

        Datang::where('karyawan_id', $id)->delete();
        IsKeluar::where('karyawan_id', $id)->delete();
        IsMasuk::where('karyawan_id', $id)->delete();
        Pulang::where('karyawan_id', $id)->delete();
        Izin::where('karyawan_id', $id)->delete();
        Kunjungan::where('karyawan_id', $id)->delete();
        Absen::where('karyawan_id', $id)->delete();

        $this->dispatchBrowserEvent('triggerJs');
    }
}
