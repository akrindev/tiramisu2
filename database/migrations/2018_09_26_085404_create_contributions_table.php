<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContributionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contributions', function (Blueprint $table) {
            $table->increments('id');
          	$table->integer('user_id');
          	$table->integer('point')->default(0);
            $table->timestamps();
        });

      	Schema::create('contribution_drops', function (Blueprint $table) {
            $table->increments('id');
          	$table->integer('user_id');
          	$table->integer('drop_id');
          	$table->string('name');
          	$table->string('picture')->nullable();
          	$table->integer('accepted')->default(0);
            $table->timestamps();
        });

      	Schema::create('drop_done', function (Blueprint $table) {
        	$table->increments('id');
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
        Schema::dropIfExists('contributions');
        Schema::dropIfExists('contribution_drops');
        Schema::dropIfExists('drop_done');
    }
}