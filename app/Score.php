<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    //
    protected $fillable = ['id_siswa','id_ujian','total_nilai','total_nilaiqe'];
}
