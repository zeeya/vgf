<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReturnRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('return_request', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('n_kvps')->nullable();
            // $table->unsignedBigInteger('adress_shipping_id');
            // $table->foreign('adress_shipping_id')->references('id')->on('adress_shipping');
            // $table->unsignedBigInteger('adress_billing_id');
            // $table->foreign('adress_billing_id')->references('id')->on('adress_billing');
            $table->unsignedBigInteger('package_designation_id');
            $table->foreign('package_designation_id')->references('id')->on('package_designation');
            $table->unsignedBigInteger('return_type_id');
            $table->foreign('return_type_id')->references('id')->on('return_type');
            $table->float('weight_kg')->nullable();
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
        Schema::dropIfExists('return_request');
    }
}
