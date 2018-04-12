<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGearrequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gearrequests', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->text('equipment');
            $table->integer('gearevent_id')->unsigned()->nullable()->default(null);
            $table->integer('users_id')->unsigned()->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gearrequests');
    }
}