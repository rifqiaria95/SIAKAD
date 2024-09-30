<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Helpers\Helper;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KelasController extends Controller
{
    public function index(Request $request)
    {
        // Menampilkan Data kelas
        $guru = Guru::all();
        $jurusan = Jurusan::all();
        $kelas = Kelas::all();
        if ($request->ajax()) {
            return datatables()->of($kelas)
                ->addColumn('guru', function(Kelas $kelas) {
                    return $kelas->guru->nama_guru;
                })
                ->addColumn('jurusan', function(Kelas $kelas) {
                    return $kelas->jurusan->nama_jurusan;
                })
                ->addColumn('aksi', function ($data) {
                    $button = '<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                        <div class="btn-group me-2" role="group" aria-label="First group">
                            <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $data->id . '" data-original-title="Edit" class="edit btn btn-info btn-sm edit-kelas"><i class="far fa-edit"></i></a>
                            <button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>
                            <button type="button" data-id="' . $data->id . '" class="view btn btn-secondary btn-sm view-siswa"><i class="far fa-eye"></i></button>
                        </div>
                    </div>';
                    return $button;
                })
                ->rawColumns(['jurusan', 'guru', 'aksi'])
                ->addIndexColumn()
                ->toJson();
        }

        return view('kelas.index', compact(['kelas', 'guru', 'jurusan']));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_kelas'     => 'required|string|max:30',
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
            $nama_kelas = $request->nama_kelas;
            $guru_id    = $request->guru_id;
            $jurusan_id = $request->jurusan_id;

            $generator         = Helper::IDGenerator(new Kelas, 'kode_kelas', 4, 'TP');
            $kelas             = new Kelas;
            $kelas->kode_kelas = $generator;
            $kelas->nama_kelas = $nama_kelas;
            $kelas->guru_id    = $guru_id;
            $kelas->jurusan_id = $jurusan_id;
            $kelas->save();
            
            return response()->json([
                'status' => 200,
                'message' => 'Sukses! Data kelas Berhasil Ditambahkan'
            ]);
        }
    }

    public function edit($id)
    {
        $kelas = Kelas::find($id);
        return response()->json($kelas);
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_kelas'     => 'required|string|max:30',
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
            $kelas             = Kelas::find($id);
            $kelas->nama_kelas = $request->nama_kelas;
            $kelas->guru_id    = $request->guru_id;
            $kelas->jurusan_id = $request->jurusan_id;
            $kelas->save();
            
            return response()->json([
                'status' => 200,
                'message' => 'Sukses! Data Kelas Berhasil Diubah'
            ]);
        }
    }

    public function destroy($id)
    {
        $kelas = Kelas::find($id);
        if($kelas)
        {
            $kelas->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Sukses! Data Kelas Berhasil Dihapus'
            ]);
        }
        else
        {
            return response()->json([
                'status' => 404,
                'errors' => 'Error! Data Kelas Tidak Ditemukan'
            ]);
        }
    }
    
    public function view(Request $request)
    {
        $siswa = Siswa::OrderBy('nama_depan', 'asc')->where('kelas_id', $request->id)->get();

        foreach ($siswa as $val) {
            $newForm[] = array(
                'kelas' => $val->kelas->nama_kelas,
                'nisn' => $val->nisn,
                'nama_depan' => $val->nama_depan,
                'jenis_kelamin' => $val->jenis_kelamin,
            );
        }

        return response()->json($newForm);
    }

}
