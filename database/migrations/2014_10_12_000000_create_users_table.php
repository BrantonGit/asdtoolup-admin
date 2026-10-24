<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->tinyInteger('role')->default(0);
            $table->string('fname')->default('N/A')->nullable();
            $table->string('lname')->default('N/A')->nullable();
            $table->string('phone')->default('N/A')->nullable();
            $table->string('company')->default('N/A')->nullable();
            $table->string('profession')->default('N/A')->nullable();
            $table->string('address')->default('N/A')->nullable();
            $table->string('city')->default('N/A')->nullable();
            $table->string('postal')->default('N/A')->nullable();
            $table->tinyInteger('notifications')->default(1);
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
        Schema::dropIfExists('users');
    }
}
