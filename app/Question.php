<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //
    protected $fillable = ['id_ujian','pertanyaan','kunci_jawaban'];
}
