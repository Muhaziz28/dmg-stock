<?php

namespace App\Http\Controllers;

use App\Models\Variasi;
use Illuminate\Http\Request;
use DataTables;

class VariasiController extends Controller
{
    public function getVariasi()
    {
        $variasi = Variasi::all();
        return DataTables::of($variasi)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="btn-group">
                            <button class="btn btn-warning" data-id="' . $row['id'] . '" id="editVariasi">Update</button>
                            <button class="btn btn-danger" data-id="' . $row['id'] . '" id="deleteVariasi">Delete</button>
                        </div>';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function addVariasi(Request $request)
    {
        $validate = \Validator::make($request->all(), [
            'nama_variasi' => 'required|string|max:255',
            'keterangan'         => ''
        ]);

        if (!$validate->passes()) {
            return response()->json(['code' => 0, 'error' => $validate->errors()->toArray()]);
        } else {
            $variasi = new Variasi();
            $variasi->nama_variasi = $request->nama_variasi;
            $variasi->keterangan = $request->keterangan;
            $query = $variasi->save();

            if (!$query) {
                return response()->json(['code' => 0, 'msg' => 'Gagal menambahkan variasi']);
            } else {
                return response()->json(['code' => 1, 'msg' => 'Berhasil menambahkan variasi!']);
            }
        }
    }

    public function deleteVariasi(Request $request)
    {
        $variasi_id = $request->variasi_id;
        $query = Variasi::find($variasi_id)->delete();

        if ($query) {
            return response()->json(['code' => 1, 'msg' => 'Berhasil menghapus variasi']);
        } else {
            return response()->json(['code' => 0, 'msg' => 'Gagal menghapus variasi']);
        }
    }

    public function detailVariasi(Request $request)
    {
        $variasi_id = $request->variasi_id;
        $variasiDetails = Variasi::find($variasi_id);
        return response()->json(['details' => $variasiDetails]);
    }

    public function updateVariasi(Request $request)
    {
        $variasi_id = $request->id;

        $validator = \Validator::make($request->all(), [
            'nama_variasi' => 'required|unique:variasis,nama_variasi,' . $variasi_id,
            'keterangan' => ''
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {

            $variasi = Variasi::find($variasi_id);
            $variasi->nama_variasi = $request->nama_variasi;
            $variasi->keterangan = $request->keterangan;
            $query = $variasi->save();

            if ($query) {
                return response()->json(['code' => 1, 'msg' => 'Data variasi berhasil diubah!']);
            } else {
                return response()->json(['code' => 0, 'msg' => 'Terjadi kesalahan!']);
            }
        }
    }
}
