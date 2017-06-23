<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClicksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clicks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('search_id')->unsigned()->nullable();           
            $table->foreign('search_id')->references('id')->on('searches');
            $table->integer('category_id')->unsigned()->nullable();           
            $table->foreign('category_id')->references('id')->on('categories');
            $table->integer('subcategory_id')->unsigned()->nullable();           
            $table->foreign('subcategory_id')->references('id')->on('subcategories');
            $table->integer('subject_id')->unsigned()->nullable();           
            $table->foreign('subject_id')->references('id')->on('subjects');
            $table->integer('metadata_id')->unsigned()->nullable();           
            $table->foreign('metadata_id')->references('id')->on('metadatas');
            $table->integer('warc_id')->unsigned()->nullable();           
            $table->foreign('warc_id')->references('id')->on('warcs');
            $table->string('id_address', 45)->nullable();
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
        Schema::dropIfExists('clicks');
    }
}
