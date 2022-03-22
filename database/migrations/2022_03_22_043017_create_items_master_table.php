<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items_master', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('company_id')->nullable();
            $table->string('name', 191);
            $table->integer('hsn_id');
            $table->float('opening_balance', 10, 0)->nullable();
            $table->float('sale_price', 10, 0)->nullable();
            $table->float('purchase_price', 10, 0)->nullable();
            $table->string('unit_id', 191)->index('items_master_unit_id_foreign');
            $table->string('item_group_id', 191)->index('items_master_item_group_id_foreign');
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
        Schema::dropIfExists('items_master');
    }
}
