<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items_master',function (Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string('unit_id');
            $table->string('item_group_id');
            $table->timestamps();

            $table->foreign('unit_id')->references('id')->on('units_master');
            $table->foreign('item_group_id')->references('id')->on('items_group_masters');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items_master');
    }
}
