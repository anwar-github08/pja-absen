<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KunjunganController extends Controller
{
    public function index($id_jabatan)
    {
        return view('kunjungan', [

            'title' => 'Kunjungan',
            'id_jabatan' => $id_jabatan
        ]);
    }
}
