<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class GuruController extends Controller
{
    public function index(Request $request)
    {
        // Menampilkan Data guru
        $guru = Guru::all();
        if ($request->ajax()) {
            return datatables()->of($guru)
                ->addColumn('aksi', function ($data) {
                    $button = '<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                        <div class="btn-group me-2" role="group" aria-label="First group">
                        <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $data->id . '" data-original-title="Edit" class="edit btn btn-info btn-sm edit-guru"><i class="far fa-edit"></i></a>
                            <button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>
                            <a href="guru/' . $data->id . '/profile" name="view" class="view btn btn-secondary btn-sm"><i class="far fa-eye"></i></a>
                        </div>
                    </div>';
                    return $button;
                })
                ->rawColumns(['aksi'])
                ->addIndexColumn()
                ->toJson();
        }

        return view('guru.index');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'avatar' => 'mimes:jpg,png'
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        }
        else {
             // Insert Table User
             $user = new User;
             $user->role = 'guru';
             $user->name = $request->nama_guru;
             $user->email = $request->email;
             $user->email_verified_at = now();
             $user->password = bcrypt('rahasia');
             $user->remember_token = Str::random(60);
             $user->save();

            // Insert Table guru
            $request->request->add(['user_id' => $user->id]);
            $guru = Guru::create($request->all());
            if($guru)
            {
                if ($request->hasfile('avatar')) {
                    $request->file('avatar')->move('images/', $request->file('avatar')->getClientOriginalName());
                    $guru->avatar = $request->file('avatar')->getClientOriginalName();
                }
                
                $guru->save(); 

                return response()->json([
                    'status' => 200,
                    'message' => 'Data guru Berhasil Ditambahkan'
                ]);
            }
            else {
                return response()->json([
                    'status' => 404,
                    'errors' => 'Data guru Tidak Ditemukan'
                ]);
            }
        }
    }

    public function edit($id)
    {
        $guru = Guru::find($id);
        return response()->json($guru);
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'avatar' => 'mimes:jpg,png'
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        }
        else {
            $guru = Guru::find($id);
            if($guru)
            {
                $guru->update($request->all());

                if ($request->hasfile('avatar')) {
                    $path = 'images/' .$guru->avatar;
                    if(File::exists($path))
                    {
                        File::delete($path);
                    }

                    $request->file('avatar')->move('images/', $request->file('avatar')->getClientOriginalName());
                    $guru->avatar = $request->file('avatar')->getClientOriginalName();
                }

                $guru->save(); 

                return response()->json([
                    'status' => 200,
                    'message' => 'Data Berhasil Diupdate'
                ]);
            }
            else {
                return response()->json([
                    'status' => 404,
                    'errors' => 'guru Tidak Ditemukan'
                ]);
            }
        }
    }

    public function destroy($id)
    {
        $guru = Guru::find($id);
        $guru->kelas()->delete();
        if($guru)
        {
            $path = 'images/'. $guru->avatar;
            if(File::exists($path))
            {
                File::delete($path);
            }
            $guru->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Data guru Berhasil Dihapus'
            ]);
        }
        else
        {
            return response()->json([
                'status' => 404,
                'errors' => 'Data guru Tidak Ditemukan'
            ]);
        }
    }

    public function profile($id)
    {
        $guru = Guru::find($id); 
        return view('guru.profile', ['guru' => $guru]);
    }
}
