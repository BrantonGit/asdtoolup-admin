<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TradedupSectionSubmission extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Each one of these submissions will be attached to the tradedup_sections which will be linked to the submission. This way we can have as many products selected as desired.
        
        Schema::create('tradedup_section_submission', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('tradedup_section_id');
            $table->string('product_id');
            $table->integer('quantity');
            $table->integer('value');
            //16-01-2019: We do not know what this will entail and how it will work with celum yet. Will most likely be pulled into this and we'll have to utilize a celum api link?
            $table->rememberToken();
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
