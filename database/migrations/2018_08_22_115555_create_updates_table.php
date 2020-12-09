<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUpdatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('updates')){
        Schema::create('updates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('left_text')->nullable();
            $table->string('right_text')->nullable();
            $table->string('image')->nullable();
            $table->string('link')->nullable();
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
        Schema::drop('updates');
    }
}
