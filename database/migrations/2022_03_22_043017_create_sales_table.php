<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->bigInteger('company_id')->nullable();
            $table->bigInteger('account_id')->nullable();
            $table->text('bill_date')->nullable();
            $table->text('purchase_date')->nullable();
            $table->string('invoice_number', 295)->nullable();
            $table->string('company_state_code', 10)->nullable();
            $table->float('total_amount', 10, 0)->nullable();
            $table->float('total_discount', 10, 0)->nullable();
            $table->float('total_net_amount', 10, 0)->nullable();
            $table->float('cgst', 10, 0)->nullable();
            $table->float('sgst', 10, 0)->nullable();
            $table->float('igst', 10, 0)->nullable();
            $table->float('tcs', 10, 0)->nullable();
            $table->string('round_off_type', 20)->nullable()->comment('1 = plus, 0 = minius
plus = credit , minius = debit');
            $table->float('round_off_value', 10, 0)->nullable();
            $table->float('grand_total_amount', 10, 0)->nullable();
            $table->text('bill_products_json')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->string('party_name', 100)->nullable();
            $table->text('address')->nullable();
            $table->text('address2')->nullable();
            $table->bigInteger('country_id')->nullable()->index('country_id');
            $table->bigInteger('state_id')->nullable()->index('state_id');
            $table->bigInteger('city_id')->nullable()->index('city_id');
            $table->string('pin_code', 20)->nullable();
            $table->string('mobile', 20)->nullable();
            $table->string('gstin', 20)->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
