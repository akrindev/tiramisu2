<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkillListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skill_lists', function (Blueprint $table) {
            $table->increments('id');
          	$table->integer('skill_id');
          	$table->string('name');
          	$table->string('type');
          	$table->integer('element_id')->nullable();
          	$table->string('for');
          	$table->integer('mp')->nullable();
          	$table->integer('range')->nullable();
          	$table->integer('level');
          	$table->enum('combo_awal', [0 ,1])->nullable();
          	$table->enum('combo_tengah', [0 ,1])->nullable();
          	$table->longText('description')->nullable();
          	$table->string('picture')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('skill_lists');
    }
}