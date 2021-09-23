<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Mapel;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MapelController extends Controller
{
    public function index(Request $request)
    {
        // Menampilkan Data mapel
        $guru = Guru::all();
        $mapel = Mapel::all();
        if ($request->ajax()) {
            return datatables()->of($mapel)
                ->addColumn('guru', function(Mapel $mapel) {
                    return $mapel->guru->nama_guru;
                })
                ->addColumn('aksi', function ($data) {
                    $button = '<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                        <div class="btn-group me-2" role="group" aria-label="First group">
                            <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $data->id . '" data-original-title="Edit" class="edit btn btn-info btn-sm edit-mapel"><i class="far fa-edit"></i></a>
                            <button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>
                        </div>
                    </div>';
                    return $button;
                })
                ->rawColumns(['guru', 'aksi'])
                ->addIndexColumn()
                ->toJson();
        }

        return view('mapel.index', compact(['mapel', 'guru']));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama'     => 'required|string|max:30',
            'semester'     => 'required|max:15',
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
            $nama = $request->nama;
            $semester = $request->semester;
            $guru_id = $request->guru_id;

            $generator = Helper::IDGenerator(new Mapel, 'kode', 4, 'MP');
            $mapel = new Mapel;
            $mapel->kode = $generator;
            $mapel->nama = $nama;
            $mapel->semester = $semester;
            $mapel->guru_id = $guru_id;
            $mapel->save();
            
            return response()->json([
                'status' => 200,
                'message' => 'Sukses! Data Mapel Berhasil Ditambahkan'
            ]);

        }
    }

    public function edit($id)
    {
        $mapel = Mapel::find($id);
        return response()->json($mapel);
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama'     => 'required|string|max:30',
            'semester'     => 'required|max:15',
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
            $mapel = Mapel::find($id);
            $mapel->nama = $request->nama;
            $mapel->semester = $request->semester;
            $mapel->guru_id = $request->guru_id;
            $mapel->save();
            
            return response()->json([
                'status' => 200,
                'message' => 'Sukses! Data Mapel Berhasil Ditambahkan'
            ]);
        }
    }

    public function destroy($id)
    {
        $mapel = Mapel::find($id);
        if($mapel)
        {
            $mapel->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Sukses! Data Mapel Berhasil Dihapus'
            ]);
        }
        else
        {
            return response()->json([
                'status' => 404,
                'errors' => 'Error! Data Mapel Tidak Ditemukan'
            ]);
        }
    }

}
