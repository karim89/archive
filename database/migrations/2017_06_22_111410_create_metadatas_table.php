<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMetadatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('metadatas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('source_id')->unsigned()->nullable();           
            $table->foreign('source_id')->references('id')->on('sources');
            $table->integer('category_id')->unsigned()->nullable();           
            $table->foreign('category_id')->references('id')->on('categories');
            $table->integer('subcategory_id')->unsigned()->nullable();           
            $table->foreign('subcategory_id')->references('id')->on('subcategories');
            $table->integer('subject_id')->unsigned()->nullable();           
            $table->foreign('subject_id')->references('id')->on('subjects');
            $table->integer('record_id')->unsigned()->nullable();           
            $table->foreign('record_id')->references('id')->on('records');
            $table->integer('media_id')->unsigned()->nullable();           
            $table->foreign('media_id')->references('id')->on('medias');
            $table->integer('language_id')->unsigned()->nullable();           
            $table->foreign('language_id')->references('id')->on('languages');
            $table->integer('location_id')->unsigned()->nullable();           
            $table->foreign('location_id')->references('id')->on('locations');
            $table->integer('status_id')->unsigned()->nullable();           
            $table->foreign('status_id')->references('id')->on('statuses');
            $table->integer('security_id')->unsigned()->nullable();           
            $table->foreign('security_id')->references('id')->on('securities');
            $table->text('title_bm')->nullable();
            $table->text('title_eng')->nullable();
            $table->string('url', 100)->nullable();
            $table->longText('description_bm')->nullable();
            $table->longText('description_eng')->nullable();
            $table->mediumText('keyword_bm')->nullable();
            $table->mediumText('keyword_eng')->nullable();
            $table->string('code', 20)->nullable();
            $table->text('path')->nullable();
            $table->integer('total_hit')->nullable();
            $table->integer('total_warc')->nullable();
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
        Schema::dropIfExists('metadatas');
    }
}
