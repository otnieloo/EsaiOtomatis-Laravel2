<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Similarity extends Model
{
    //
    protected $fillable = ['id_jawaban','id_soal','nilai_similaritas','nilai_similaritasqe','nilai_sistem','total_konversi','total_konversiqe'];
}
