<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHsnMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hsn_master',function (Blueprint $table){
            $table->increments('id');
            $table->string('hsn_code');
            $table->string('hsn_description');
            $table->string('min_amount');
            $table->string('gst_min_percentage');
            $table->string('gst_max_percentage');
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
        Schema::dropIfExists('hsn_master');
    }
}
