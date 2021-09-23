<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Siswa;
use App\Models\Jurusan;
use Illuminate\Support\Str;
use App\Exports\SiswaExport;
use App\Imports\SiswaImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        // Menampilkan Data Siswa
        $kelas = Kelas::all();
        $jurusan = Jurusan::all();
        $siswa = Siswa::all();
        // dd($kelas);
        if ($request->ajax()) {
            return datatables()->of($siswa)
                ->addColumn('kelas', function(Siswa $siswa) {
                    return $siswa->kelas->nama_kelas;
                })
                ->addColumn('jurusan', function(Siswa $siswa) {
                    return $siswa->jurusan->nama_jurusan;
                })
                ->addColumn('rata2_nilai', function ($data) {
                    return $data->avg();
                })
                ->addColumn('aksi', function ($data) {
                    $button = '<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                        <div class="btn-group me-2" role="group" aria-label="First group">
                            <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $data->id . '" data-original-title="Edit" class="edit btn btn-info btn-sm edit-siswa"><i class="far fa-edit"></i></a>
                            <button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>
                            <a href="siswa/' . $data->id . '/profile" name="view" class="view btn btn-secondary btn-sm"><i class="far fa-eye"></i></a>
                        </div>
                    </div>';
                    return $button;
                })
                ->rawColumns(['kelas', 'aksi'])
                ->addIndexColumn()
                ->toJson();
        }

        return view('siswa.index', compact(['siswa', 'kelas', 'jurusan']));
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
            $user->role = 'Siswa';
            $user->name = $request->nama_depan;
            $user->email = $request->email;
            $user->email_verified_at = now();
            $user->password = bcrypt('rahasia');
            $user->remember_token = Str::random(60);
            $user->save();

            // Insert Table Siswa
            $request->request->add(['user_id' => $user->id]);
            $siswa = Siswa::create($request->all());
            if($siswa)
            {
                if ($request->hasfile('avatar')) {
                    $request->file('avatar')->move('images/', $request->file('avatar')->getClientOriginalName());
                    $siswa->avatar = $request->file('avatar')->getClientOriginalName();
                }
                $siswa->save(); 

                return response()->json([
                    'status' => 200,
                    'message' => 'Data Siswa Berhasil Ditambahkan'
                ]);
            }
            else {
                return response()->json([
                    'status' => 404,
                    'errors' => 'Data Siswa Tidak Ditemukan'
                ]);
            }
        }
    }

    public function edit($id)
    {
        $siswa = Siswa::find($id);
        return response()->json($siswa);
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
            $siswa = Siswa::find($id);
            if($siswa)
            {
                $siswa->update($request->all());

                if ($request->hasfile('avatar')) {
                    $path = 'images/' .$siswa->avatar;
                    if(File::exists($path))
                    {
                        File::delete($path);
                    }

                    $request->file('avatar')->move('images/', $request->file('avatar')->getClientOriginalName());
                    $siswa->avatar = $request->file('avatar')->getClientOriginalName();
                }

                $siswa->save(); 

                return response()->json([
                    'status' => 200,
                    'message' => 'Data Berhasil Diupdate'
                ]);
            }
            else {
                return response()->json([
                    'status' => 404,
                    'errors' => 'Siswa Tidak Ditemukan'
                ]);
            }
        }
    }

    public function destroy($id)
    {
        $siswa = Siswa::find($id);
        if($siswa)
        {
            $path = 'images/'. $siswa->avatar;
            if(File::exists($path))
            {
                File::delete($path);
            }
            $siswa->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Data Siswa Berhasil Dihapus'
            ]);
        }
        else
        {
            return response()->json([
                'status' => 404,
                'errors' => 'Data Siswa Tidak Ditemukan'
            ]);
        }
    }

    public function profile($id)
    {
        $kelas = Kelas::all();
        $jurusan = Jurusan::all();
        $siswa = Siswa::find($id);
        $matapelajaran = Mapel::all();

        // Menyiapkan data charts
        $categories = [];
        $data = [];

        foreach ($matapelajaran as $mp) {
            if ($siswa->mapel()->wherePivot('mapel_id', $mp->id)->first()) {
                $categories[] = $mp->nama;
                $data[] = $siswa->mapel()->wherePivot('mapel_id', $mp->id)->first()->pivot->nilai;
            }
        }

        return view('siswa.profile', compact(['kelas', 'jurusan', 'siswa', 'matapelajaran', 'categories', 'data',]));
    }

    public function addnilai(Request $request, $idsiswa)
    {
        $siswa = Siswa::find($idsiswa);
        if ($siswa->mapel()->where('mapel_id', $request->mapel)->exists()) {
            return redirect('siswa/' . $idsiswa . '/profile')->with('error', 'Mata pelajaran sudah ada!');
        }
        $siswa->mapel()->attach($request->mapel, ['nilai' => $request->nilai]);

        return redirect('siswa/' . $idsiswa . '/profile')->with('sukses', 'Nilai berhasil ditambahkan!');
    }

    public function deletenilai($idsiswa, $idmapel)
    {
        $siswa = Siswa::find($idsiswa);
        $siswa->mapel()->detach($idmapel);

        return redirect()->back()->with('sukses', 'Nilai berhasil dihapus!');
    }

    public function exportExcel()
    {
        return Excel::download(new SiswaExport, 'siswa.xlsx');
    }

    public function exportPDF()
    {
        $siswa = Siswa::all();
        $pdf = PDF::loadview('export.exportpdf', ['siswa' => $siswa]);
        return $pdf->download('siswa.pdf');
    }

    public function profilsaya()
    {
        $siswa = auth()->user()->siswa;
        return view('siswa.profilsaya', compact(['siswa']));
    }

    public function importsiswa(Request $request)
    {
        // dd($request->all());
        Excel::import(new SiswaImport, $request->file('data_siswa'));
        return redirect('siswa');
    }
}
