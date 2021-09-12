<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Siswa;
use App\Models\User;
use App\Models\Mapel;
use App\Exports\SiswaExport;
use PDF;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        // Menampilkan Data Siswa
        $siswa = Siswa::all();
        if($request->ajax()){
            return datatables()->of($siswa)
            ->addColumn('rata2_nilai', function($data){
                return $data->avg();
            })
            ->addColumn('aksi', function($data){
                $button = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-warning btn-sm edit-siswa"><i class="far fa-edit"></i> Edit</a>';
                $button .= '&nbsp;&nbsp;';
                $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i> Delete</button>';     
                return $button;
            })
            ->rawColumns(['aksi'])
            ->addIndexColumn()
            ->toJson();
        }

        return view('siswa.index');

    }
    
    public function store(Request $request)
    {
        $id = $request->id;
        $user = User::updateOrCreate([
            [
                'id' => $id
            ],
                'role' => 'siswa',
                'name' => $request->nama_depan,
                'email' => $request->email,
                'email_verified_at' => now(),
                'password' => bcrypt('rahasia'),
                'remember_token' => Str::random(60),
            ]);
        
        $siswa = Siswa::updateOrCreate(
            [
                'user_id'=>$user->id,
                'id' => $id
            ],
            [
                'nama_depan' => $request->nama_depan,
                'nama_belakang' => $request->nama_belakang,
                'jenis_kelamin' => $request->jenis_kelamin,
                'agama' => $request->agama,
                'alamat' => $request->alamat,
                'avatar' => $request->avatar,
            ]);

        if($request->hasfile('avatar')) {
            $request->file('avatar')->move('images/', $request->file('avatar')->getClientOriginalName());
            $siswa->avatar = $request->file('avatar')->getClientOriginalName();
            $siswa->save();
        }

        return json_encode(array(
            "statusCode"=>200
        ));
    }

    public function edit($id, Request $request)
    {
        $this->validate($request, [
            'avatar' => 'mimes:jpg,png'
        ]);

        // $where = array('users.id' => $id);
        $siswa = Siswa::select(

            "siswa.id", 
            "siswa.nama_depan",
            "siswa.nama_belakang", 
            "siswa.jenis_kelamin", 
            "users.email as email",
            "siswa.agama",
            "siswa.alamat"

        )

        ->join('users', 'users.id', '=', 'siswa.user_id')
        ->where('siswa.id', $id)
        ->first();
        
        if($request->hasfile('avatar')) {
            $request->file('avatar')->move('images/', $request->file('avatar')->getClientOriginalName());
            $siswa->avatar = $request->file('avatar')->getClientOriginalName();
            $siswa->update();
        }

        return response()->json($siswa);
    }

    public function delete($id)
    {
        $siswa = Siswa::find($id);
        $siswa->delete();
        return redirect('/siswa')->with('sukses', 'Data Berhasil Dihapus');
    }

    public function profile($id)
    {
        $siswa = Siswa::find($id);
        $matapelajaran = Mapel::all();

        // Menyiapkan data charts
        $categories = [];
        $data = [];
        
        foreach($matapelajaran as $mp) {
            if($siswa->mapel()->wherePivot('mapel_id',$mp->id)->first()){
                $categories[] = $mp->nama;
                $data[] = $siswa->mapel()->wherePivot('mapel_id', $mp->id)->first()->pivot->nilai;

            }
        }

        return view('siswa.profile', ['siswa' => $siswa, 'matapelajaran' => $matapelajaran, 'categories' => $categories, 'data' => $data]);
    }

    public function addnilai(Request $request, $idsiswa)
    {
        $siswa = Siswa::find($idsiswa);
        if($siswa->mapel()->where('mapel_id', $request->mapel)->exists()){
            return redirect('siswa/' .$idsiswa. '/profile')->with('error', 'Mata pelajaran sudah ada!');
        }
        $siswa->mapel()->attach($request->mapel, ['nilai' => $request->nilai]);

        return redirect('siswa/' .$idsiswa. '/profile')->with('sukses', 'Nilai berhasil ditambahkan!');
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
        $pdf = PDF::loadview('export.exportpdf', ['siswa'=>$siswa]);
        return $pdf->download('siswa.pdf');
    }

}
