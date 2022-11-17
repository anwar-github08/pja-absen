<?php

namespace App\Http\Livewire\Izin;

use App\Models\Izin;
use App\Models\Absen;
use Livewire\Component;
use App\Models\Karyawan;

date_default_timezone_set('Asia/Bangkok');

class IzinCreate extends Component
{
    public $karyawan_id = '-';
    public $tanggal_izin;
    public $jam_izin;
    public $lokasi_izin;
    public $keperluan = '';

    public $karyawans;

    public function render()
    {

        $this->tanggal_izin = date('d-m-Y');
        $this->jam_izin = date('H:i:s');
        $this->lokasi_izin = '-235252, 23235';

        // ambil id_karyawan semua
        $karyawan_id = Karyawan::select('id')->get();
        foreach ($karyawan_id as $id) {

            $karyawan_id_array[] = $id->id;
        }

        // ambil id_karyawan yang sudah ada di tabel iskeluar pada tanggal sekarang
        $karyawan_id_dipakai = Izin::select('karyawan_id')->where('tanggal_izin', date('Y-m-d'))->get();
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
        return view('livewire.izin.izin-create');
    }

    public function storeIzin()
    {

        $izin = Izin::create([

            'karyawan_id' => $this->karyawan_id,
            'tanggal_izin' => date('Y-m-d', strtotime($this->tanggal_izin)),
            'jam_izin' => $this->jam_izin,
            'lokasi_izin' => $this->lokasi_izin,
            'keperluan' => $this->keperluan
        ]);

        // simpan atau update absen
        Absen::updateOrInsert(
            [
                'karyawan_id' => $this->karyawan_id, 'tanggal_absen' => date('Y-m-d', strtotime($this->tanggal_izin))
            ],
            ['izin_id' => $izin->id]
        );

        $this->emit('eTriggerIzinShow');

        $this->karyawan_id = '-';
        $this->keperluan = '';
    }
}
