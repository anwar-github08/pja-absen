<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DatangController extends Controller
{
    public function index()
    {

        return view('datang', [

            'title' => 'Absen Datang'
        ]);
    }
}
