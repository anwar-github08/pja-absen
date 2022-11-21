<?php

namespace App\Http\Livewire\Pulang;

use App\Models\Absen;
use App\Models\Pulang;
use Livewire\Component;
use App\Models\Karyawan;
use Livewire\WithFileUploads;

date_default_timezone_set('Asia/Bangkok');

class PulangCreate extends Component
{

    use WithFileUploads;

    public $karyawan_id = '-';
    public $tanggal_pulang;
    public $jam_pulang;
    public $lokasi_pulang;
    public $foto_pulang;

    public $karyawans;

    public function render()
    {

        $this->tanggal_pulang = date('d-m-Y');
        $this->jam_pulang = date('H:i:s');
        $this->lokasi_pulang = '-235252, 23235';

        // ambil id_karyawan semua
        $karyawan_id = Karyawan::select('id')->get();
        foreach ($karyawan_id as $id) {

            $karyawan_id_array[] = $id->id;
        }

        // ambil id_karyawan yang sudah ada di tabel datang pada tanggal sekarang
        $karyawan_id_dipakai = Pulang::select('karyawan_id')->where('tanggal_pulang', date('Y-m-d'))->get();
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


        return view('livewire.pulang.pulang-create');
    }


    // real time validation
    protected $rules = ['foto_pulang' => 'image'];
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function storePulang()
    {

        // validasi
        $this->validate([
            'foto_pulang' => 'image'
        ]);

        // buat nama foto
        $imgName = date('dmyhis') . $this->karyawan_id . '.' . $this->foto_pulang->extension();

        // simpan foto di direktori
        $this->foto_pulang->storeAs('foto_pulang', $imgName, 'public');

        // simpan di db
        $pulang = Pulang::create([

            'karyawan_id' => $this->karyawan_id,
            'tanggal_pulang' => date('Y-m-d', strtotime($this->tanggal_pulang)),
            'jam_pulang' => $this->jam_pulang,
            'lokasi_pulang' => $this->lokasi_pulang,
            'foto_pulang' => $imgName
        ]);


        // simpan atau update absen
        Absen::updateOrInsert(
            [
                'karyawan_id' => $this->karyawan_id, 'tanggal_absen' => date('Y-m-d', strtotime($this->tanggal_pulang))
            ],
            ['pulang_id' => $pulang->id, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]
        );

        // buat emit untuk trigger pulang-show
        $this->emit('eTriggerPulangShow');

        $this->karyawan_id = '-';
        $this->foto_pulang = null;
    }
}
