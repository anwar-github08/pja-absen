<?php

namespace App\Http\Livewire\Istirahat;

use App\Models\Absen;
use App\Models\IsMasuk;
use Livewire\Component;
use App\Models\Karyawan;

date_default_timezone_set('Asia/Bangkok');

class IsMasukCreate extends Component
{
    public $karyawan_id = '-';
    public $tanggal_is_masuk;
    public $jam_is_masuk;
    public $lokasi_is_masuk;

    public $karyawans;

    public function render()
    {
        $this->tanggal_is_masuk = date('d-m-Y');
        $this->jam_is_masuk = date('H:i:s');
        $this->lokasi_is_masuk = '-235252, 23235';

        // ambil id_karyawan semua
        $karyawan_id = Karyawan::select('id')->get();
        foreach ($karyawan_id as $id) {

            $karyawan_id_array[] = $id->id;
        }

        // ambil id_karyawan yang sudah ada di tabel iskeluar pada tanggal sekarang
        $karyawan_id_dipakai = IsMasuk::select('karyawan_id')->where('tanggal_is_masuk', date('Y-m-d'))->get();
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

        return view('livewire.istirahat.is-masuk-create');
    }

    public function storeIsMasuk()
    {

        // langsung simpan di db
        $isMasuk = IsMasuk::create([

            'karyawan_id' => $this->karyawan_id,
            'tanggal_is_masuk' => date('Y-m-d', strtotime($this->tanggal_is_masuk)),
            'jam_is_masuk' => $this->jam_is_masuk,
            'lokasi_is_masuk' => $this->lokasi_is_masuk
        ]);

        // simpan atau update absen
        Absen::updateOrInsert(
            [
                'karyawan_id' => $this->karyawan_id, 'tanggal_absen' => date('Y-m-d', strtotime($this->tanggal_is_masuk))
            ],
            ['is_masuk_id' => $isMasuk->id]
        );


        $this->emit('eTriggerIsMasukShow');

        $this->karyawan_id = '-';
    }
}
