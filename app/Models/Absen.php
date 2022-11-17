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

    public function datang()
    {
        return $this->belongsTo(Datang::class);
    }
    public function is_keluar()
    {
        return $this->belongsTo(IsKeluar::class);
    }
    public function is_masuk()
    {
        return $this->belongsTo(IsMasuk::class);
    }
    public function pulang()
    {
        return $this->belongsTo(Pulang::class);
    }
    public function izin()
    {
        return $this->belongsTo(Izin::class);
    }
}
