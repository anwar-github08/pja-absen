<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PulangController extends Controller
{
    public function index()
    {

        return view('pulang', [

            'title' => 'Absen Pulang'
        ]);
    }
}
