<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNilaiKonversi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('similarities', function (Blueprint $table) {
            //
            $table->double('nilai_konversi',8,2);
            $table->double('nilai_konversiqe',8,2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('similarities', function (Blueprint $table) {
            //
            $table->drop('nilai_konversi');
            $table->drop('nilai_konversiqe');
        });
    }
}
