<?php

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

Route::get('/', 'AccountController@home');

Route::get('/login', 'AccountController@index');

Route::post('/login', 'AccountController@login');

Route::post('/logout', 'AccountController@logout');

Route::get('/register', 'AccountController@create');

Route::post('/register', 'AccountController@store');

// Pengajar

Route::get('/pengajar', 'PengajarController@index');

Route::get('/buat_ujian', 'PengajarController@buatUjian');

Route::post('/buat_ujian', 'PengajarController@store');

Route::get('/edit_ujian/{id}', 'PengajarController@editUjian');

Route::patch('/edit_ujian/{id}', 'PengajarController@update');

Route::delete('/hapus_ujian', 'PengajarController@destroy');

Route::get('/hasil_ujian/{id}', 'PengajarController@hasilUjian');
Route::get('/hasil_ujian', 'PengajarController@hasilUjian');
Route::get('/export/{id}', 'PengajarController@export');

Route::get('/cek_ujian', function () {
    return view('pengajar/cek_ujian');
});

Route::get('/cek_jawaban', function () {
    return view('pengajar/cek_jawaban');
});

// Siswa
Route::get('/siswa', 'SiswaController@index');

Route::get('/enroll', 'SiswaController@enroll');

Route::post('/enroll', 'SiswaController@enrollUjian');

Route::post('/cek_enroll', 'SiswaController@cekEnroll');

Route::get('/isi_ujian/{id}', 'SiswaController@isiUjian');

Route::post('/isi_ujian', 'SiswaController@submitIsiUjian');

Route::get('/lihat_ujian/{id}', 'SiswaController@lihatUjian');
Route::get('/lihat_ujian', 'SiswaController@lihatUjian');

Route::get('/api', 'SiswaController@consumeApi');


Route::get('/sb', function () {
    return view('sb_index');
});
