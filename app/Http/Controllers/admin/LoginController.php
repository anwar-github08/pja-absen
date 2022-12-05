<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {

        return view('admin.login.index');
    }

    public function auth(Request $request)
    {

        $dataValid = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($dataValid)) {
            $request->session()->regenerate();

            return redirect()->intended('/admin');
        }

        return back()->with('error', 'Gagal..!!!');
    }
}
