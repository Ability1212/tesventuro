<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TabelController extends Controller
{
    public function index() {
        return view('tabel');
    }

    public function tahun($param) {
        if(!is_numeric($param))
        return view('tabel');

        $getMenu = file_get_contents("http://127.0.0.1:8000/api/menu");
        $menu = json_decode($getMenu,true);

        $getTr = file_get_contents("http://127.0.0.1:8000/api/transaksi?tahun=".$param);
        $transaksi = json_decode($getTr,true);

        return view('tabel', [
            'tahun' => $param,
            'menu' => $menu,
            'transaksi' => $transaksi
        ]);
    }
}
