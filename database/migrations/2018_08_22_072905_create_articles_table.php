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
        if(!Schema::hasTable('articles')){
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('banner')->nullable();
            $table->string('main_heading')->nullable();
            $table->string('sub_heading')->nullable();
            $table->string('author')->nullable();
            $table->timestamps();
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
        Schema::drop('articles');
    }
}
