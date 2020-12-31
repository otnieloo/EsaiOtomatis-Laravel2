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

Route::get('/', function () {
    return view('front/home');
});

Route::get('/login', 'AccountController@index');

Route::post('/login', 'AccountController@login');

Route::get('/register', 'AccountController@create');

Route::post('/register', 'AccountController@store');

// Pengajar

Route::get('/pengajar', function () {
    return view('pengajar/home');
});

Route::get('/buat_ujian', function () {
    return view('pengajar/buat_ujian');
});

Route::get('/hasil_ujian', function () {
    return view('pengajar/hasil_ujian');
});

Route::get('/cek_ujian', function () {
    return view('pengajar/cek_ujian');
});

Route::get('/cek_jawaban', function () {
    return view('pengajar/cek_jawaban');
});

// Siswa
Route::get('/siswa', function () {
    return view('siswa/home');
});

Route::get('/enroll', function () {
    return view('siswa/enroll_ujian');
});

Route::get('/lihat_ujian', function () {
    return view('siswa/lihat_ujian');
});

Route::get('/isi_soal', function () {
    return view('siswa/isi_soal');
});

Route::get('/sb', function () {
    return view('sb_index');
});
