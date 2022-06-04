<?php

namespace App\Http\Controllers;

use App\Models\Bahan;
use App\Models\Barang;
use App\Models\Keluar;
use App\Models\Masuk;
use App\Models\Variasi;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function index()
    {
        $data['masuk'] = Masuk::where('tanggal', '=', date('Y-m-d'))->count();
        $data['keluar'] = Keluar::where('tanggal', '=', date('Y-m-d'))->count();
        return view('pages.index', $data);
    }
    public function barang()
    {
        $data['variasis'] = Variasi::all();
        $data['bahans'] = Bahan::all();
        return view('pages.barang', $data);
    }
    public function variasi()
    {
        return view('pages.variasi');
    }
    public function bahan()
    {
        return view('pages.bahan');
    }
    public function masuk()
    {
        $data['barang'] = Barang::all();

        return view('pages.masuk', $data);
    }
    public function keluar()
    {
        $data['barang'] = Barang::where('stok', '>', 0)->get();
        return view('pages.keluar', $data);
    }
}
