<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempMonstersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_monsters', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->integer('monster_id')->nullable();
            $table->tinyInteger('approved')->default(0);
            $table->integer('map_id');
            $table->tinyInteger('element_id');
          	$table->string('name');
          	$table->string('name_en');
          	$table->integer('level');
          	$table->tinyInteger('type');
          	$table->integer('hp')->nullable();
          	$table->integer('xp')->nullable();
          	$table->enum('pet',['y', 'n']);
          	$table->string('picture')->nullable();
            $table->timestamps();
        });


        Schema::create('temp_monster_drop', function (Blueprint $table) {
          	$table->integer('temp_monster_id');
          	$table->integer('drop_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('temp_monsters');
        Schema::dropIfExists('temp_monster_drop');
    }
}
