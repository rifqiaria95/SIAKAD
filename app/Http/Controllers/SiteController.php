<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Siswa;
use App\Models\User;
use App\Models\Post;

class SiteController extends Controller
{
    public function home()
    {
        $posts = Post::all();
        return view('sites.home', compact('posts'));
    }

    public function postregister(Request $request)
    {
        $user = new User;
        $user->role = 'Siswa';
        $user->name = $request->nama_depan;
        $user->email = $request->email;
        $user->email_verified_at = now();
        $user->password = bcrypt($request->password);
        $user->remember_token = Str::random(60);
        $user->save();

        $request->request->add(['user_id'=>$user->id]);
        $siswa = Siswa::create($request->all());

        \Mail::raw('Selamat Datang '.$user->name, function ($message) use($user)
        {
            $message->to($user->email, $user->name);
            $message->subject('Selamat anda telah terdaftar di SMK Ti Tunas Harapan');
        });

        return redirect('/')->with('sukses', 'Pendaftaran Berhasil!');
    }

    public function singlepost($slug)
    {
        $post = Post::where('slug', '=', $slug)->first();
        return view('sites.singlepost', compact('post'));
    }
}
