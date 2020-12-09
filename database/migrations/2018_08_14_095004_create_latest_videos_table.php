<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLatestVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('latest_videos')){
        Schema::create('latest_videos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('video_text')->nullable();
            $table->string('video_link')->nullable();
            $table->string('image')->nullable();
            $table->integer('status')->nullable();
            $table->integer('sort_order')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('latest_videos');
    }
}
