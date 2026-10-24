<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CustomerinfoSections extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    //Each submission from the customer will have a traded-in section id that will link to this section. 
        //This section will act as a container for all of the selected traded-in products uploaded.
        
        //The history stage will capture this module's status at each update in order to archive it.
        Schema::create('customerinfo_sections', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('submission_id');
            $table->tinyInteger('status');
            $table->string('comments')->nullable(); //Not accessible by the customers.
            $table->tinyInteger('reason_id')->nullable(); //Not accessible by the customers.


            //When creating a submission, by default the user's profile info will be generated. But they are able to switch it if desired, hence why we need this section.
            //There will only ever be one info submission per rebate. We do not need to have a table for entries linking to this.
            $table->string('fname')->default('N/A')->nullable();
            $table->string('lname')->default('N/A')->nullable();
            $table->string('phone')->default('N/A')->nullable();
            $table->string('email')->default('N/A')->nullable();
            $table->string('company')->default('N/A')->nullable();
            $table->string('profession')->default('N/A')->nullable();
            $table->string('address')->default('N/A')->nullable();
            $table->string('city')->default('N/A')->nullable();
            $table->string('postal')->default('N/A')->nullable();


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
