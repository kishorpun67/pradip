<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('section_id');
            $table->unsignedBigInteger('category_id');
            $table->string('product_name');
            $table->string('product_price');
            $table->string('product_discount');
            $table->string('product_image');
            $table->string('product_code');
            $table->string('product_color');

            $table->text('description');
            $table->tinyInteger('status');
            $table->timestamps();

            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prouducts');
    }
}
