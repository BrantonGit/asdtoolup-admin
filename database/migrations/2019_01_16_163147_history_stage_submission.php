<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class HistoryStageSubmission extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_stage_submission', function (Blueprint $table) {
            $table->increments('id');

            //By capturing the section IDs. We can go into it and pluck the current status, reason and comments and successfully archive it.
            $table->tinyInteger('author_id');
            $table->tinyInteger('history_stages_submission_id')->nullable();
            $table->tinyInteger('customerinfo_section_id');
            $table->tinyInteger('tradedup_section_id');
            $table->tinyInteger('tradedin_section_id');
            $table->tinyInteger('receipt_section_id');
            $table->string('message')->default('Stage updated');
            $table->string('messagefr')->default('Stage updated');
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
