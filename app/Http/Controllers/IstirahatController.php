<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IstirahatController extends Controller
{
    public function isKeluar()
    {

        return view('is_keluar', [

            'title' => 'Absen Istirahat'
        ]);
    }

    public function isMasuk()
    {

        return view('is_masuk', [

            'title' => 'Absen Istirahat'
        ]);
    }
}
