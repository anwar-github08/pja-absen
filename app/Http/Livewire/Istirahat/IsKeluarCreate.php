<?php

namespace App\Http\Livewire\Istirahat;

use Livewire\Component;
use App\Models\IsKeluar;
use App\Models\Karyawan;

class IsKeluarCreate extends Component
{
    public $karyawan_id = '-';
    public $tanggal_is_keluar;
    public $jam_is_keluar;
    public $lokasi_is_keluar;

    public $karyawans;

    public function render()
    {
        $this->tanggal_is_keluar = date('d-m-Y');
        $this->lokasi_is_keluar = '-235252, 23235';

        // ambil id_karyawan semua
        $karyawan_id = Karyawan::select('id')->get();
        foreach ($karyawan_id as $id) {

            $karyawan_id_array[] = $id->id;
        }

        // ambil id_karyawan yang sudah ada di tabel iskeluar pada tanggal sekarang
        $karyawan_id_dipakai = IsKeluar::select('karyawan_id')->where('tanggal_is_keluar', date('Y-m-d'))->get();
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

        return view('livewire.istirahat.is-keluar-create');
    }

    public function storeIsKeluar()
    {

        dd($this->jam_is_keluar);
    }
}
