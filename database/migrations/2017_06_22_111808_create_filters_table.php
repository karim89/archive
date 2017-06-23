<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFiltersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filters', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('metadata_id')->unsigned()->nullable();           
            $table->foreign('metadata_id')->references('id')->on('metadatas');
            $table->integer('crawl_id')->unsigned()->nullable();           
            $table->foreign('crawl_id')->references('id')->on('crawls');
            $table->integer('security_id')->unsigned()->nullable();           
            $table->foreign('security_id')->references('id')->on('securities');
            $table->integer('status_id')->unsigned()->nullable();           
            $table->foreign('status_id')->references('id')->on('statuses');
            $table->mediumText('delete')->nullable();
            $table->string('path', 45)->nullable();
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
        Schema::dropIfExists('filters');
    }
}
