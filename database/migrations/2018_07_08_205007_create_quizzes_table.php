<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->increments('id');
          	$table->integer('user_id');
          	$table->text('question');
          	$table->text('answer_a');
          	$table->text('answer_b');
          	$table->text('answer_c');
          	$table->text('answer_d');
          	$table->string('correct');
          	$table->boolean('approved')->default(1);
          	$table->integer('views')->default(0);
          	$table->integer('benar')->default(0);
          	$table->integer('salah')->default(0);
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
        Schema::dropIfExists('quizzes');
    }
}