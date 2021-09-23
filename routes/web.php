<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route Auth
Route::get('/', 'SiteController@home');
Route::get('/register', 'SiteController@register');
Route::post('/postregister', 'SiteController@postregister');

Auth::routes();

Route::group(['middleware' => ['auth', 'checkRole:Admin']], function () {
    // Route Siswa
    Route::get('siswa', 'SiswaController@index');
    Route::post('siswa/store', 'SiswaController@store');
    Route::get('siswa/edit/{id}', 'SiswaController@edit');
    Route::post('siswa/update/{id}', 'SiswaController@update');
    Route::delete('siswa/delete/{id}', 'SiswaController@destroy');
    Route::get('siswa/{id}/profile', 'SiswaController@profile');
    Route::post('siswa/{id}/addnilai', 'SiswaController@addnilai');
    Route::get('siswa/{id}/{idmapel}/deletenilai', 'SiswaController@deletenilai');
    Route::get('siswa/exportexcel/', 'SiswaController@exportexcel');
    Route::get('siswa/exportpdf/', 'SiswaController@exportPDF');
    Route::post('siswa/import/', 'SiswaController@importsiswa')->name('siswa.import');

    // Route Guru
    Route::get('guru', 'GuruController@index');
    Route::post('guru/store', 'GuruController@store');
    Route::get('guru/edit/{id}', 'GuruController@edit');
    Route::post('guru/update/{id}', 'GuruController@update');
    Route::delete('guru/delete/{id}', 'GuruController@destroy');
    Route::get('guru/{id}/profile', 'GuruController@profile');

    // Route Mapel
    Route::get('mapel', 'MapelController@index');
    Route::post('mapel/store', 'MapelController@store');
    Route::get('mapel/edit/{id}', 'MapelController@edit');
    Route::post('mapel/update/{id}', 'MapelController@update');
    Route::delete('mapel/delete/{id}', 'MapelController@destroy');

    // Route Kelas
    Route::get('kelas', 'KelasController@index');
    Route::post('kelas/store', 'KelasController@store');
    Route::get('kelas/edit/{id}', 'KelasController@edit');
    Route::post('kelas/update/{id}', 'KelasController@update');
    Route::delete('kelas/delete/{id}', 'KelasController@destroy');
    Route::get('kelas/view', 'KelasController@view');

    // Route Jurusan
    Route::get('jurusan', 'JurusanController@index');
    Route::post('jurusan/store', 'JurusanController@store');
    Route::get('jurusan/edit/{id}', 'JurusanController@edit');
    Route::post('jurusan/update/{id}', 'JurusanController@update');
    Route::delete('jurusan/delete/{id}', 'JurusanController@destroy');

    // Route User
    Route::get('user', 'UserController@index');

    // Route Posts
    Route::get('/posts', 'PostController@index')->name('posts.index');
    Route::get('post/add', [
        'uses' => 'PostController@add',
        'as' => 'posts.add',
    ]);
    Route::post('post/create', [
        'uses' => 'PostController@create',
        'as' => 'posts.create',
    ]);
});

Route::group(['middleware' => ['auth', 'checkRole:Admin, Siswa, Guru']], function () {

    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
});

Route::group(['middleware' => ['auth', 'checkRole:Siswa']], function () {

    Route::get('/profilsaya', 'SiswaController@profilsaya');
});

Route::get('/{slug}', [
    'uses' => 'SiteController@singlepost',
    'as' => 'site.single.post'
]);
