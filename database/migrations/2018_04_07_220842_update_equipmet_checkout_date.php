<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateEquipmetCheckoutDate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       
        
        Schema::table('equipment', function($table) {
         $table->dateTime('chekout_date')->nullable()->change();
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
         $table->dateTime('chekout_date')->change();
        });
    }
}
