<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCfsv2sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cfsv2s', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->string('station_id');
            $table->double('gph200_0');
            $table->double('gph200_6');
            $table->double('gph200_12');
            $table->double('gph200_18');
            $table->double('gph850_0');
            $table->double('gph850_6');
            $table->double('gph850_12');
            $table->double('gph850_18');
            $table->double('h200_0');
            $table->double('h200_6');
            $table->double('h200_12');
            $table->double('h200_18');
            $table->double('h850_0');
            $table->double('h850_6');
            $table->double('h850_12');
            $table->double('h850_18');
            $table->double('temp200_0');
            $table->double('temp200_6');
            $table->double('temp200_12');
            $table->double('temp200_18');
            $table->double('temp850_0');
            $table->double('temp850_6');
            $table->double('temp850_12');
            $table->double('temp850_18');
            $table->double('u200_0');
            $table->double('u200_6');
            $table->double('u200_12');
            $table->double('u200_18');
            $table->double('u850_0');
            $table->double('u850_6');
            $table->double('u850_12');
            $table->double('u850_18');
            $table->double('v200_0');
            $table->double('v200_6');
            $table->double('v200_12');
            $table->double('v200_18');
            $table->double('v850_0');
            $table->double('v850_6');
            $table->double('v850_12');
            $table->double('v850_18');
            $table->double('p_msl_0');
            $table->double('p_msl_6');
            $table->double('p_msl_12');
            $table->double('p_msl_18');
            $table->double('p_sfl_0');
            $table->double('p_sfl_6');
            $table->double('p_sfl_12');
            $table->double('p_sfl_18');
            $table->double('rainfall');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cfsv2s');
    }
}
