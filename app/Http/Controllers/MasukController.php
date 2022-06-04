<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Masuk;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;

class MasukController extends Controller
{
    public function getMasuk()
    {
        if (request()->input('barang') != null && request()->input('tanggal') == null) {
            $masuk = Masuk::with('barang')->where('id_barang', request()->input('barang'))->get();
        } else if (request()->input('barang') == null && request()->input('tanggal') != null) {
            $masuk = Masuk::with('barang')->where('tanggal', '=', request()->input('tanggal'))->get();
        } else {
            $masuk = Masuk::with('barang')->get();
        }
        return DataTables::of($masuk)
            ->addIndexColumn()
            ->make(true);
    }

    public function addMasuk(Request $request)
    {
        $validate = \Validator::make($request->all(), [
            'tanggal'    => 'required',
            'id_barang'    => 'required',
            'stok_masuk'    => 'required',
        ]);

        if (!$validate->passes()) {
            return response()->json(['code' => 0, 'error' => $validate->errors()->toArray()]);
        } else {
            $masuk = new Masuk();
            $masuk->tanggal = $request->tanggal;
            $masuk->id_barang = $request->id_barang;
            $masuk->stok_masuk = $request->stok_masuk;

            $getBarang = Barang::find($request->id_barang);
            // jumlahkan stok_masuk dengan stok, insert ke tabel barang
            $getBarang->stok = $getBarang->stok + $request->stok_masuk;
            // update stok di tabel barang
            $getBarang->save();

            $masuk->stok_awal = $getBarang->stok;
            $query = $masuk->save();

            if (!$query) {
                return response()->json(['code' => 0, 'msg' => 'Gagal menambahkan barang masuk']);
            } else {
                return response()->json(['code' => 1, 'msg' => 'Berhasil menambahkan barang masuk!']);
            }
        }
    }
}
