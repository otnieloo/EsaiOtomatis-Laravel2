<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Similarity extends Model
{
    //
    protected $fillable = ['id_jawaban','id_soal','nilai_similaritas','nilai_similaritasqe','nilai_sistem','nilai_konversi','nilai_konversiqe'];
}
