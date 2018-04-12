<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserToEquipment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
         Schema::table('equipment', function($table) {
         $table->integer('user_id')->unsigned()->nullable()->default(null);
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('equipment', function($table) {
        $table->dropColumn('user_id');
        });
    }
}
