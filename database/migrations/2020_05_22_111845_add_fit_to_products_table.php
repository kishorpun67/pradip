<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFitToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('product_weight');
            $table->string('wash_care');
            $table->string('fabric');
            $table->string('product_video'); 
            $table->string('pattern');
            $table->string('sleeve');
            $table->string('fit');
            $table->string('ocassion');
            $table->string('meta_title');
            $table->string('meta_description');
            $table->string('meta_keywords');
            $table->enum('is_feature', ['No','Yes']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            
        });
    }
}
