<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScammersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scammers', function (Blueprint $table) {
            $table->increments('id');
          	$table->integer('user_id');
          	$table->integer('cat_scammer_id');
          	$table->string('judul');
          	$table->longText('body');
          	$table->string('facebook')->nullable();
          	$table->string('line')->nullable();
          	$table->string('ign')->nullable();
          	$table->integer('spina')->nullable();
          	$table->string('slug');
            $table->timestamps();
          	$table->softDeletes();
        });

      	Schema::create('cat_scammers', function (Blueprint $table) {
            $table->increments('id');
          	$table->string('name');
            $table->timestamps();
        });

      	Schema::create('scammer_pics', function (Blueprint $table) {
            $table->increments('id');
          	$table->integer('user_id');
          	$table->integer('scammer_id');
          	$table->text('url');
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
        Schema::dropIfExists('scammers');
        Schema::dropIfExists('scammer_pics');
        Schema::dropIfExists('cat_scammers');

    }
}