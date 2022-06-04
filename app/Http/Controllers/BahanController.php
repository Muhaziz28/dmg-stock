<?php

namespace App\Http\Controllers;

use App\Models\Bahan;
use Illuminate\Http\Request;
use DataTables;

class BahanController extends Controller
{
    public function getBahan()
    {
        $bahan = Bahan::all();
        return DataTables::of($bahan)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="btn-group">
                            <button class="btn btn-warning" data-id="' . $row['id'] . '" id="editBahan">Update</button>
                            <button class="btn btn-danger" data-id="' . $row['id'] . '" id="deleteBahan">Delete</button>
                        </div>';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function addBahan(Request $request)
    {
        $validate = \Validator::make($request->all(), [
            'nama_bahan'    => 'required|string|max:255',
            'keterangan'    => ''
        ]);

        if (!$validate->passes()) {
            return response()->json(['code' => 0, 'error' => $validate->errors()->toArray()]);
        } else {
            $bahan = new Bahan();
            $bahan->nama_bahan = $request->nama_bahan;
            $bahan->keterangan = $request->keterangan;
            $query = $bahan->save();

            if (!$query) {
                return response()->json(['code' => 0, 'msg' => 'Gagal menambahkan bahan']);
            } else {
                return response()->json(['code' => 1, 'msg' => 'Berhasil menambahkan bahan!']);
            }
        }
    }

    public function deleteBahan(Request $request)
    {
        $bahan_id = $request->bahan_id;
        $query = Bahan::find($bahan_id)->delete();

        if ($query) {
            return response()->json(['code' => 1, 'msg' => 'Berhasil menghapus bahan']);
        } else {
            return response()->json(['code' => 0, 'msg' => 'Gagal menghapus bahan']);
        }
    }

    public function detailBahan(Request $request)
    {
        $bahan_id = $request->bahan_id;
        $bahanDetails = Bahan::find($bahan_id);
        return response()->json(['details' => $bahanDetails]);
    }

    public function updateBahan(Request $request)
    {
        $bahan_id = $request->id;

        $validator = \Validator::make($request->all(), [
            'nama_bahan' => 'required|unique:bahans,nama_bahan,' . $bahan_id,
            'keterangan' => ''
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {

            $bahan = Bahan::find($bahan_id);
            $bahan->nama_bahan = $request->nama_bahan;
            $bahan->keterangan = $request->keterangan;
            $query = $bahan->save();

            if ($query) {
                return response()->json(['code' => 1, 'msg' => 'Data bahan berhasil diubah!']);
            } else {
                return response()->json(['code' => 0, 'msg' => 'Terjadi kesalahan!']);
            }
        }
    }
}
