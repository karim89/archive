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
            $table->integer('avatar_id')->unsigned()->nullable();           
            $table->foreign('avatar_id')->references('id')->on('avatars');
            $table->integer('gender_id')->unsigned()->nullable();           
            $table->foreign('gender_id')->references('id')->on('genders');
            $table->integer('user_id')->unsigned()->nullable();           
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('name');
            $table->string('username');
            $table->string('email');
            $table->string('password');
            $table->integer('year')->nullable();
            $table->decimal('number', 5, 0)->nullable();
            $table->string('researcher_number', 20)->nullable();
            $table->string('mykad', 45)->nullable();
            $table->date('birtdate')->nullable();
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
