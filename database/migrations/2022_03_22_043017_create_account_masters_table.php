<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_masters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 191)->nullable();
            $table->string('email', 191)->nullable();
            $table->string('phone', 191)->nullable();
            $table->text('address')->nullable();
            $table->double('opening_balance', 8, 2)->nullable();
            $table->string('account_type', 191)->nullable()->comment('Debit,Credit');
            $table->string('dealer_type', 191)->nullable()->comment('Registered,Unregistered');
            $table->unsignedBigInteger('city_id')->nullable();
            $table->unsignedBigInteger('state_id')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->string('pincode', 191)->nullable();
            $table->string('gstin', 191)->nullable();
            $table->string('pan', 191)->nullable();
            $table->string('gst_state_code', 10)->nullable();
            $table->string('bank_name', 191)->nullable();
            $table->string('branch_name', 191)->nullable();
            $table->string('account_number', 191)->nullable();
            $table->string('ifsc_code', 191)->nullable();
            $table->string('account_holder_name', 191)->nullable();
            $table->unsignedBigInteger('account_group_id');
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
        Schema::dropIfExists('account_masters');
    }
}
