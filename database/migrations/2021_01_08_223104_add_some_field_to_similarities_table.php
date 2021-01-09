<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSomeFieldToSimilaritiesTable extends Migration
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
            $table->double('nilai_similaritasce',8,2)->after('nilai_similaritas');
            $table->double('nilai_sistem',8,2)->after('nilai_similaritasce');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('similarites', function (Blueprint $table) {
            $table->dropColumn('nilai_similaritasce');
            $table->dropColumn('nilai_sistem');
        });
    }
}
