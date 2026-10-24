<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TradedupSections extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Each submission from the customer will have a traded-up section id that will link to this section. 
        //This section will act as a container for all of the selected traded-up products attached.
        
        //The history stage will capture this module's status at each update in order to archive it.
        Schema::create('tradedup_sections', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('submission_id');
            $table->tinyInteger('status');
            $table->string('comments')->nullable(); //Not accessible by the customers.
            $table->tinyInteger('reason_id')->nullable(); //Not accessible by the customers.
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
