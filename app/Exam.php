<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    //
    protected $fillable = ['nama','jadwal','jumlah_soal','kode_ujian','id_pengajar']; 
}
