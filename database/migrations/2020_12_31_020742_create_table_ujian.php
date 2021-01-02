<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUjian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->increments('id_ujian');
            $table->string('nama');
            $table->integer('jumlah_soal');
            $table->integer('id_pengajar');
            $table->string('kode_ujian');
            $table->dateTime('jadwal');
            $table->dateTime('jadwal_selesai');
            $table->integer('durasi');
            $table->string('status',1)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exams');
    }
}
