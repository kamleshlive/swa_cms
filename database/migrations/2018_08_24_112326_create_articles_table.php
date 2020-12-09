<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('art_main_heading')->nullable();
            $table->string('art_sub_heading')->nullable();
            $table->string('art_author_id');
            $table->longText('art_contect')->nullable();
            $table->date('art_date')->nullable();
            $table->string('art_category_id');
            $table->integer('view')->nullable();
            $table->integer('publish')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('articles');
    }
}
