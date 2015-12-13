<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStationInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('station_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('station_id');
            $table->string('station_name');
            $table->string('sub_district');
            $table->string('district');
            $table->string('province');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('station_infos');
    }
}
