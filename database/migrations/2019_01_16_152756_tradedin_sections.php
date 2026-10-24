<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TradedinSections extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Each submission from the customer will have a traded-in section id that will link to this section. 
        //This section will act as a container for all of the uploaded traded-in products.
        
        //The history stage will capture this module's status at each update in order to archive it.
        Schema::create('tradedin_sections', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('submission_id');
            $table->tinyInteger('status');
            $table->string('comments')->nullable(); //Not accessible by the customers.
            $table->string('vendor')->nullable(); 
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
