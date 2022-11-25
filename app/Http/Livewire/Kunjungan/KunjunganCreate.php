<?php

namespace App\Http\Livewire\Kunjungan;

use Livewire\Component;
use App\Models\Karyawan;
use App\Models\Kunjungan;
use Livewire\WithFileUploads;

date_default_timezone_set('Asia/Bangkok');
class KunjunganCreate extends Component
{
    use WithFileUploads;

    public $karyawan_id = '-';
    public $tanggal_kunjungan;
    public $jam_kunjungan;
    public $lokasi_kunjungan;
    public $foto_kunjungan;
    public $id_jabatan;

    public $karyawans;

    public function mount($id_jabatan)
    {
        $this->id_jabatan = $id_jabatan;
    }


    public function render()
    {
        $this->tanggal_kunjungan = date('d-m-Y');
        $this->jam_kunjungan = date('H:i:s');
        $this->lokasi_kunjungan = '-235252, 23235';

        // ambil id_karyawan semua
        $karyawan_id = Karyawan::select('id')->where('jabatan_id', $this->id_jabatan)->get();
        foreach ($karyawan_id as $id) {

            $karyawan_id_array[] = $id->id;
        }

        // ambil id_karyawan yang sudah ada di tabel kunjungan pada tanggal sekarang
        $karyawan_id_dipakai = Kunjungan::select('karyawan_id')->where('tanggal_kunjungan', date('Y-m-d'))->get();
        foreach ($karyawan_id_dipakai as $key) {
            $karyawan_id_dipakai_array[] = $key->karyawan_id;
        }

        // jika belum ada absen notyet = id karyawan
        if (empty($karyawan_id_dipakai_array)) {
            $this->karyawans = Karyawan::where('jabatan_id', $this->id_jabatan)->orderBy('nama_karyawan', 'asc')->get();
        } else {
            $notYetId = array_diff($karyawan_id_array, $karyawan_id_dipakai_array);
            $this->karyawans = Karyawan::whereIn('id', $notYetId)->orderBy('nama_karyawan', 'asc')->get();
        }

        return view('livewire.kunjungan.kunjungan-create');
    }


    protected $rules = ['foto_kunjungan' => 'image'];
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function storeKunjungan()
    {
        // validasi
        $this->validate([
            'foto_kunjungan' => 'image'
        ]);

        // buat nama foto
        $imgName = date('dmyhis') . $this->karyawan_id . '.' . $this->foto_kunjungan->extension();

        // simpan foto di direktori
        $this->foto_kunjungan->storeAs('foto_kunjungan', $imgName, 'public');

        // simpan di db
        Kunjungan::create([

            'karyawan_id' => $this->karyawan_id,
            'tanggal_kunjungan' => date('Y-m-d', strtotime($this->tanggal_kunjungan)),
            'jam_kunjungan' => $this->jam_kunjungan,
            'lokasi_kunjungan' => $this->lokasi_kunjungan,
            'foto_kunjungan' => $imgName
        ]);


        // buat emit untuk trigger kunjungan-show
        $this->emit('eTriggerKunjunganShow');

        $this->karyawan_id = '-';
        $this->foto_kunjungan = null;
    }
}
