<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class);
    }

    public function jam_kerja()
    {
        return $this->belongsTo(JamKerja::class)->withDefault();
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
