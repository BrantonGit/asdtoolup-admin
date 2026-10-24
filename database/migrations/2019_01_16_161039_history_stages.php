<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class HistoryStages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_stages', function (Blueprint $table) {
            $table->increments('id');

            //Everytime an update happens, it will look inside the submission and look at it's section IDs. 
            //From there, it will determine each section's status and archive it the history_stage_submission table.
            $table->tinyInteger('submission_id')->nullable(); 
            
            //The naming convention is author because it could be either a customer or admin who created a history stage. 
            //Customers will always create an initial stage when they first submit a rebate.
            //Admins will create a new stage when they submit their review.
            $table->tinyInteger('author_id'); 
            // $table->tinyInteger('history_stage_submission_id')->nullable(); 

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
