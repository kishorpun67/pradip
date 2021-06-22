<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('user_email');
            $table->string('name');
            $table->string('address');
            $table->string('city');
            $table->string('stat');
            $table->string('country');
            $table->string('pincode');
            $table->string('mobile');
            $table->string('shipping_charges');
            $table->string('coupon_code');
            $table->string('coupon_amount');
            $table->string('status');
            $table->string('payment_method');
            $table->string('grand_total');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
