<?php

namespace App\Http\Controllers;

use App\Models\JabatanKunjungan;
use App\Models\Kunjungan;
use Illuminate\Http\Request;

class KunjunganController extends Controller
{
    public function index()
    {

        return view('kunjungan', [

            'title' => 'Kunjungan',
        ]);
    }
}
