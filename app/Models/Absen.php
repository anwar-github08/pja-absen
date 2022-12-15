<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }
    public function jam_kerja()
    {
        return $this->belongsTo(JamKerja::class)->withDefault();
    }
    public function datang()
    {
        return $this->belongsTo(Datang::class)->withDefault();
    }
    public function is_keluar()
    {
        return $this->belongsTo(IsKeluar::class)->withDefault();
    }
    public function is_masuk()
    {
        return $this->belongsTo(IsMasuk::class)->withDefault();
    }
    public function pulang()
    {
        return $this->belongsTo(Pulang::class)->withDefault();
    }
    // public function izin()
    // {
    //     return $this->belongsTo(Izin::class)->withDefault();
    // }

    // fungsi with default untuk megizinkan agar id yang tidak ada bisa ditampikan
}
