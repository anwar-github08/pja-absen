<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\JabatanKunjungan;

class isKunjungan
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $jabatanKunjungan = JabatanKunjungan::select('jabatan_id')->get();
        foreach ($jabatanKunjungan as $key) {
            $idJabatanKunjungan[] = $key->jabatan_id;
        }

        // jika belum login atau login tapi jabtan_id tidak sama dengan id_jabatan_kunjungan, maka alihkan home

        if (!auth()->check()  || !in_array(auth()->user()->jabatan_id, $idJabatanKunjungan)) {
            return redirect()->intended('/');
        }
        return $next($request);
    }
}
