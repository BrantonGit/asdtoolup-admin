<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TradeInProductsSection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //THIS WILL BE SWITCHED TO TARGET TRADE-IN SECTION.
        //WAS INITIALLY FOR RECEIPTS BUT HAS BEEN REQUESTED TO SWITCH OVER.
        Schema::create('tradein_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tradedin_section_id');
            $table->string('product_number'); //Some of the product numbers have letters in them.
            $table->string('brand')->default('Not defined');
            $table->integer('product_qty');
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
        //
    }
}
