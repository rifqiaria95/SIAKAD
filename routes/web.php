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

Route::group(['middleware' => ['auth', 'checkRole:admin']], function () {
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
    Route::get('/guru', 'GuruController@index');
    Route::post('guru/store', 'GuruController@store');
    Route::get('guru/{id}/profile', 'GuruController@profile');

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

Route::group(['middleware' => ['auth', 'checkRole:admin,siswa']], function () {

    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
});

Route::group(['middleware' => ['auth', 'checkRole:siswa']], function () {

    Route::get('/profilsaya', 'SiswaController@profilsaya');
});

Route::get('/{slug}', [
    'uses' => 'SiteController@singlepost',
    'as' => 'site.single.post'
]);
