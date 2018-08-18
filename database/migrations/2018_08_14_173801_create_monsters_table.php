<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMonstersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monsters', function (Blueprint $table) {
            $table->increments('id');
          	$table->integer('map_id');
          	$table->tinyInteger('element_id');
          	$table->string('name');
          	$table->integer('level');
          	$table->tinyInteger('type');
          	$table->integer('hp')->nullable();
          	$table->integer('xp')->nullable();
          	$table->enum('pet',['y', 'n']);
          	$table->string('picture')->nullable();
        });

        Schema::create('monster_drop', function (Blueprint $table) {
            $table->increments('id');
          	$table->integer('monster_id')->references('id')->on('drops')->onDelete('cascade');

          	$table->integer('drop_id')->references('id')->on('monsters')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('monsters');
    }
}