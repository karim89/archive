<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWarcsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warcs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('thumbnail_id')->unsigned()->nullable();           
            $table->foreign('thumbnail_id')->references('id')->on('thumbnails');
            $table->integer('metadata_id')->unsigned()->nullable();           
            $table->foreign('metadata_id')->references('id')->on('metadatas');
            $table->integer('crawl_id')->unsigned()->nullable();           
            $table->foreign('crawl_id')->references('id')->on('crawls');
            $table->integer('filter_id')->unsigned()->nullable();           
            $table->foreign('filter_id')->references('id')->on('filters');
            $table->integer('year')->nullable();
            $table->string('record_code', 20)->nullable();
            $table->decimal('number', 6, 0)->nullable();
            $table->string('location_code', 20)->nullable();
            $table->string('accession_number', 20)->nullable();
            $table->dateTime('filter_date', 20)->nullable();
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
        Schema::dropIfExists('warcs');
    }
}
