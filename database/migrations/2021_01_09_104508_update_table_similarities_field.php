<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTableSimilaritiesField extends Migration
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
            $table->renameColumn('nilai_similaritasce','nilai_similaritasqe');
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
            $table->renameColumn('nilai_similaritasqe','nilai_similaritasce');
        });
    }
}
