<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Keluar;
use Illuminate\Http\Request;
use DataTables;

class KeluarController extends Controller
{
    public function getKeluar()
    {
        $keluar = Keluar::with('barang')->orderBy('created_at', 'desc')->get();
        return DataTables::of($keluar)
            ->addIndexColumn()
            ->make(true);
    }

    public function addKeluar(Request $request)
    {
        $validate = \Validator::make($request->all(), [
            'tanggal'    => 'required',
            'id_barang'    => 'required',
            'stok_keluar'    => 'required',
        ]);

        if (!$validate->passes()) {
            return response()->json(['code' => 0, 'error' => $validate->errors()->toArray()]);
        } else {
            $keluar = new Keluar();
            $keluar->tanggal = $request->tanggal;
            $keluar->id_barang = $request->id_barang;
            $keluar->stok_keluar = $request->stok_keluar;

            $getBarang = Barang::find($request->id_barang);

            $getBarang->stok = $getBarang->stok - $request->stok_keluar;

            $getBarang->save();

            $keluar->stok_awal = $getBarang->stok;

            $query = $keluar->save();

            if (!$query) {
                return response()->json(['code' => 0, 'msg' => 'Gagal menambahkan barang keluar']);
            } else {
                return response()->json(['code' => 1, 'msg' => 'Berhasil menambahkan barang keluar!']);
            }
        }
    }
}
