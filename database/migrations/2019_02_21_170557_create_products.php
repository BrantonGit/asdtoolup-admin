<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sku');
            $table->integer('active')->default(0);
            $table->bigInteger('category_id');
            $table->string('description');
            $table->string('description_fr');
            $table->integer('list_price');
            $table->integer('rebate_value');
            $table->string('image_url')->nullable();
            $table->string('image_url_large')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
