<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    public function getBarang()
    {
        $barang = Barang::with(['variasi', 'bahan'])->get();

        return DataTables::of($barang)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="btn-group">
                            <button class="btn btn-warning" data-id="' . $row['id'] . '" id="editBarang">Update</button>
                            <button class="btn btn-danger" data-id="' . $row['id'] . '" id="deleteBarang">Delete</button>
                        </div>';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function addBarang(Request $request)
    {
        $validate = \Validator::make($request->all(), [
            'nama_barang'   => 'required',
            'kode_barang'   => 'required',
            'ukuran'        => 'required',
            'id_bahan'      => 'required',
            'id_variasi'    => 'required',
            'stok'          => 'required',
        ]);

        if (!$validate->passes()) {
            return response()->json(['code' => 0, 'error' => $validate->errors()->toArray()]);
        } else {

            foreach ($request->nama_barang as $key => $insert) {
                $saveRecord = [
                    'nama_barang'   => $request->nama_barang[$key],
                    'kode_barang'   => $request->kode_barang[$key],
                    'ukuran'        => $request->ukuran[$key],
                    'id_bahan'      => $request->id_bahan[$key],
                    'id_variasi'    => $request->id_variasi[$key],
                    'stok'          => $request->stok[$key],
                ];
                // dd($saveRecord);
                // die;    
                DB::table('barangs')->insert($saveRecord);
            }

            // cek data berhasil diinput

            return response()->json(['code' => 1, 'msg' => 'Data berhasil diinput']);
        }
    }
    public function deleteBarang(Request $request)
    {
        $barang_id = $request->barang_id;
        $query = Barang::find($barang_id)->delete();

        if ($query) {
            return response()->json(['code' => 1, 'msg' => 'Berhasil menghapus barang']);
        } else {
            return response()->json(['code' => 0, 'msg' => 'Gagal menghapus barang']);
        }
    }

    public function detailBarang(Request $request)
    {
        $barang_id = $request->barang_id;
        $barangDetails = Barang::find($barang_id);
        return response()->json(['details' => $barangDetails]);
    }

    public function updateBarang(Request $request)
    {
        $barang_id = $request->id;

        $validator = \Validator::make($request->all(), [
            'nama_barang'   => 'required|unique:barangs,nama_barang,' . $barang_id,
            'kode_barang'   => 'required',
            'ukuran'        => 'required',
            'id_bahan'      => 'required',
            'id_variasi'    => 'required',
            'stok'          => 'required',
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {

            $barang = Barang::find($barang_id);
            $barang->nama_barang = $request->nama_barang;
            $barang->kode_barang = $request->kode_barang;
            $barang->ukuran = $request->ukuran;
            $barang->id_bahan = $request->id_bahan;
            $barang->id_variasi = $request->id_variasi;
            $barang->stok = $request->stok;
            $query = $barang->save();

            if ($query) {
                return response()->json(['code' => 1, 'msg' => 'Data barang berhasil diubah!']);
            } else {
                return response()->json(['code' => 0, 'msg' => 'Terjadi kesalahan!']);
            }
        }
    }
}
