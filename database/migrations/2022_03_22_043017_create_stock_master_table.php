<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_master', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->bigInteger('account_id');
            $table->bigInteger('item_id');
            $table->string('invoice_number', 295);
            $table->text('bill_date');
            $table->bigInteger('unit_id');
            $table->string('unit_name', 100);
            $table->bigInteger('invoice_id');
            $table->float('gross_wt', 10, 0);
            $table->float('ting_wt', 10, 0);
            $table->float('net_wt', 10, 0);
            $table->float('rate_gm', 10, 0);
            $table->float('discount', 10, 0);
            $table->float('net_amount', 10, 0);
            $table->bigInteger('hsn_id');
            $table->string('hsn_code', 100);
            $table->float('cgst', 10, 0);
            $table->float('sgst', 10, 0);
            $table->float('igst', 10, 0);
            $table->float('gst_amount', 10, 0);
            $table->string('voucher_type', 60);
            $table->float('total', 10, 0);
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
        Schema::dropIfExists('stock_master');
    }
}
