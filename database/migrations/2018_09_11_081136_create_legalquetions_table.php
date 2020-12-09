 <?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLegalquetionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('legalquetions')){
        Schema::create('legalquetions', function (Blueprint $table) {
            $table->increments('id');
            $table->text('heading')->nullable();
            $table->date('date')->nullable();
            $table->string('category')->nullable();
            $table->text('content')->nullable();
            $table->timestamps();  });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('legalquetions');
    }
}
