<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hops', function (Blueprint $table) {
            $table->increments('id');
            $table->text('title_bm')->nullable();
            $table->text('title_eng')->nullable();
            $table->longText('description_bm')->nullable();
            $table->longText('description_eng')->nullable();
            $table->string('code', 20)->nullable();
            $table->integer('user_id')->unsigned()->nullable();           
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hops');
    }
}
