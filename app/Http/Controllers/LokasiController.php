<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;

class LokasiController extends Controller
{
    public function index()
    {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.bigdatacloud.net/data/client-ip");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);

        $ip = json_decode($output)->ipString;

        // // get location geoplugin
        // $geoplugin = file_get_contents("http://www.geoplugin.net/php.gp?id=" . $ip);

        // // get location torran geoapi
        // $torran = geoip()->getLocation($ip);

        $position = Location::get($ip);

        // get location stevebauman
        if ($ip) {
            // dd($position, $position->cityName, $position->latitude . ',' . $position->longitude, $geoplugin, $torran);
            return $position->latitude . ',' . $position->longitude;
        } else {
            return 'gagal';
        }
    }
}
