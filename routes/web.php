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

Route::get('/login', function () {
    return view('front/login');
});

Route::get('/register', function () {
    return view('front/register');
});

Route::get('/pengajar', function () {
    return view('pengajar/home');
});

Route::get('/buat_ujian', function () {
    return view('pengajar/buat_ujian');
});

Route::get('/sb', function () {
    return view('sb_index');
});
