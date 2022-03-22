<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinanceLedgerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finance_ledger', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->bigInteger('first_transaction_no')->nullable()->index('first_transaction_no');
            $table->bigInteger('account_id')->index('account_id');
            $table->bigInteger('account_id2')->nullable()->index('account_id2');
            $table->text('bill_date');
            $table->float('debit', 10, 0);
            $table->float('credit', 10, 0);
            $table->text('narration')->nullable();
            $table->bigInteger('bill_id')->nullable()->index('bill_id');
            $table->string('bill_number', 100)->nullable();
            $table->string('bill_type', 20)->nullable();
            $table->string('account_name', 100);
            $table->string('instr_type', 20)->nullable();
            $table->string('instrument_no', 60)->nullable();
            $table->text('instrument_date')->nullable();
            $table->bigInteger('created_by')->nullable();
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
        Schema::dropIfExists('finance_ledger');
    }
}
