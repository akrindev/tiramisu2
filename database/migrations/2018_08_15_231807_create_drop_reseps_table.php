<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDropResepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reseps', function (Blueprint $table) {
            $table->increments('id');
          	$table->integer('drop_id');
          	$table->string('material');
          	$table->string('jumlah');
          	$table->integer('fee')->nullable();
          	$table->integer('level')->nullable();
          	$table->integer('diff')->nullable();
          	$table->integer('set')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('drop_reseps');
    }
}