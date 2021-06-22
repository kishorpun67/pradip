<?php

use Illuminate\Database\Migrations\Migration; 
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('parent_id');
            $table->integer('section_id');
            $table->string('category_name')->default("null");
            $table->string('category_image')->default("null");
            $table->string('category_discount')->default("null");
            $table->text('description')->default("null");
            $table->string('url')->default("null");
            $table->string('meta_title')->default("null");
            $table->string('meta_description')->default("null");
            $table->string('meta_keywords')->default("null");
            $table->tinyInteger('status');
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
        Schema::dropIfExists('categories');
        $table->dropColumn('product_weight');
        $table->dropColumn('wash_care');
        $table->dropColumn('fabric');
        $table->dropColumn('product_video'); 
        $table->dropColumn('pattern');
        $table->dropColumn('sleeve');
        $table->dropColumn('fit');
        $table->dropColumn('ocassion');
        $table->dropColumn('meta_title');
        $table->dropColumn('meta_description');
        $table->dropColumn('meta_keywords');
        $table->dropColumn('is_feature', ['No','Yes']);
    }
}
