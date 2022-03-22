<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 191);
            $table->string('email', 295)->nullable();
            $table->string('db_name', 100)->nullable();
            $table->text('address')->nullable();
            $table->text('logo')->nullable();
            $table->string('gstin', 100)->nullable();
            $table->string('gst_state_code', 10)->nullable();
            $table->string('mobile', 20)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('pan', 100)->nullable();
            $table->string('pincode', 100)->nullable();
            $table->bigInteger('state_id')->nullable();
            $table->bigInteger('country_id')->nullable();
            $table->integer('city_id')->nullable();
            $table->text('from_date')->nullable();
            $table->text('to_date')->nullable();
            $table->text('website')->nullable();
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
        Schema::dropIfExists('companies');
    }
}
