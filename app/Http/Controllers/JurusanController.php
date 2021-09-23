<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JurusanController extends Controller
{
    public function index(Request $request)
    {
        // Menampilkan Data jurusan
        $jurusan = Jurusan::all();
        if ($request->ajax()) {
            return datatables()->of($jurusan)
                ->addColumn('aksi', function ($data) {
                    $button = '<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                        <div class="btn-group me-2" role="group" aria-label="First group">
                            <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $data->id . '" data-original-title="Edit" class="edit btn btn-info btn-sm edit-jurusan"><i class="far fa-edit"></i></a>
                            <button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>
                        </div>
                    </div>';
                    return $button;
                })
                ->rawColumns(['aksi'])
                ->addIndexColumn()
                ->toJson();
        }

        return view('jurusan.index');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_jurusan'      => 'required|string|max:30',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        }
        else {
            // dd($request->all());
            $jurusan = new Jurusan([
                'nama_jurusan' => $request->get('nama_jurusan'),
            ]);
            $jurusan->save();
            
            return response()->json([
                'status' => 200,
                'message' => 'Data jurusan Berhasil Ditambahkan'
            ]);
        }
    }

    public function edit($id)
    {
        $jurusan = Jurusan::find($id);
        return response()->json($jurusan);
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_jurusan'      => 'required|string|max:30',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        }
        else {
            // dd($request->all());
            $jurusan = Jurusan::find($id);
            $jurusan->nama_jurusan = $request->nama_jurusan;
            $jurusan->save();
            
            return response()->json([
                'status' => 200,
                'message' => 'Data jurusan Berhasil Diubah'
            ]);
        }
    }

    public function destroy($id)
    {
        $jurusan = Jurusan::find($id);
        if($jurusan)
        {
            $jurusan->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Data jurusan Berhasil Dihapus'
            ]);
        }
        else
        {
            return response()->json([
                'status' => 404,
                'errors' => 'Data jurusan Tidak Ditemukan'
            ]);
        }
    }
}
