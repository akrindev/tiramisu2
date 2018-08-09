<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_codes', function (Blueprint $table) {
            $table->increments('id');
          	$table->integer('user_id');
          	$table->integer('code');
            $table->timestamps();
        });

      	Schema::create('quiz_soal_codes', function (Blueprint $table) {
        	$table->increments('id');
          	$table->integer('quiz_code_id');
  			$table->text('body');
          	$table->string('soal');
          	$table->timestamps();
        });

      	Schema::create('quiz_score_codes', function (Blueprint $table) {
        	$table->increments('id');
          	$table->integer('user_id');
          	$table->integer('quiz_code_id');
          	$table->integer('benar');
          	$table->integer('salah');
    		$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quiz_codes');
      	Schema::dropIfExists('quiz_soal_codes');
      	Schema::dropIfExists('quiz_score_codes');
    }
}