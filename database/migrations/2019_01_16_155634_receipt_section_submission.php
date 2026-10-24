<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ReceiptSectionSubmission extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
                //Each one of these submissions will be attached to the receipt_sections which will be linked to the submission. This way we can have as many receipts uploaded as desired.
                Schema::create('receipt_section_submission', function (Blueprint $table) {
                    $table->increments('id');
                    $table->tinyInteger('receipt_section_id');
                    $table->string('photo');
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
