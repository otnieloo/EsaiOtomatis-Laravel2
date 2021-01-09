<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    //
    protected $fillable = ['id_soal','id_siswa','jawaban','id_ujian'];
}
