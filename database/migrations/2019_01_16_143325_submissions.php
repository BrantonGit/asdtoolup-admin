<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Submissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Submission table. Every section is attached via an id.
        Schema::create('customer_submissions', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('customer_id');
            $table->tinyInteger('payment_status')->default(1);
            $table->tinyInteger('customerinfo_section_id')->nullable();
            $table->tinyInteger('tradedin_section_id')->nullable();
            $table->tinyInteger('tradedup_section_id')->nullable();
            $table->tinyInteger('receipts_section_id')->nullable();
            $table->tinyInteger('history_stages_id')->nullable();
            $table->tinyInteger('status')->default(1); //Submission status
            $table->tinyInteger('active')->default(1); //Once a submission has been paid, the active status will be set to 0.
            $table->bigInteger('totalAmount')->nullable();
            $table->integer('cheque_number')->nullable();
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
