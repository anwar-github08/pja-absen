<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function showImage($kategori, $image)
    {
        if ($kategori == 'datang') {
            $title = 'Foto Datang';
        } else {
            $title = 'Foto Pulang';
        }

        return view('admin.show_image', [
            'title' => $title,
            'kategori' => $kategori,
            'image' => $image
        ]);
    }
}
