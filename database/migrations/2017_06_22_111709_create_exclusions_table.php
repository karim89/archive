<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExclusionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exclusions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('crawl_id')->unsigned()->nullable();           
            $table->foreign('crawl_id')->references('id')->on('crawls');
            $table->integer('metadata_id')->unsigned()->nullable();           
            $table->foreign('metadata_id')->references('id')->on('metadatas');
            $table->integer('format_id')->unsigned()->nullable();           
            $table->foreign('format_id')->references('id')->on('formats');
            $table->text('remark')->nullable();
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
        Schema::dropIfExists('exclusions');
    }
}
