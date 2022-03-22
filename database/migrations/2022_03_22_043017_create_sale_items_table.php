<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_items', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->bigInteger('sale_id');
            $table->bigInteger('item_id')->nullable();
            $table->string('hsn_code', 100)->nullable();
            $table->string('gross_wt', 100)->nullable();
            $table->string('net_wt', 100)->nullable();
            $table->float('ting_wt', 10, 0)->nullable();
            $table->string('rate_gm', 100)->nullable();
            $table->float('amount', 10, 0)->nullable();
            $table->float('discount_percentage', 10, 0)->nullable();
            $table->float('discount', 10, 0)->nullable();
            $table->float('net_amount', 10, 0)->nullable();
            $table->float('cgst', 10, 0)->nullable();
            $table->float('sgst', 10, 0)->nullable();
            $table->float('igst', 10, 0)->nullable();
            $table->float('gst_amount', 10, 0)->nullable();
            $table->float('total', 10, 0)->nullable();
            $table->string('unit', 100)->nullable();
            $table->bigInteger('unit_id')->nullable();
            $table->bigInteger('hsn_id')->nullable();
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
        Schema::dropIfExists('sale_items');
    }
}
