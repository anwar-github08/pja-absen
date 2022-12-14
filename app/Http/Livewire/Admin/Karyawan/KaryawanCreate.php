<?php

namespace App\Http\Livewire\Admin\Karyawan;

use App\Models\User;
use App\Models\Jabatan;
use App\Models\JamKerja;
use Livewire\Component;
use App\Models\Karyawan;
use Illuminate\Support\Facades\Hash;

class KaryawanCreate extends Component
{

    public $nama_karyawan = '';
    public $username = '';
    public $password = '';
    public $is_admin = false;
    public $jabatan_id = '-';
    public $jam_kerja_id = '-';

    public $jabatans;
    public $jam_kerjas;

    public function render()
    {
        $this->jabatans = Jabatan::orderBy('nama_jabatan', 'asc')->get();
        $this->jam_kerjas = JamKerja::orderBy('nama_jam_kerja', 'asc')->get();

        return view('livewire.admin.karyawan.karyawan-create');
    }

    public function storeKaryawan()
    {

        $karyawan =  Karyawan::create([
            'nama_karyawan' => ucwords($this->nama_karyawan),
            'jabatan_id' => $this->jabatan_id,
            'jam_kerja_id' => $this->jam_kerja_id
        ]);

        User::create([
            'karyawan_id' => $karyawan->id,
            'jabatan_id' => $this->jabatan_id,
            'name' => $this->username,
            'key' => $this->password,
            'password' => Hash::make($this->password),
            'is_admin' => $this->is_admin
        ]);


        // buat emit untuk trigger karyawan-show
        $this->emit('eTriggerKaryawanShow');
        $this->dispatchBrowserEvent('triggerJs');

        $this->nama_karyawan = '';
        $this->username = '';
        $this->password = '';
        $this->is_admin = false;
        $this->jabatan_id = '-';
        $this->jam_kerja_id = '-';
    }
}
