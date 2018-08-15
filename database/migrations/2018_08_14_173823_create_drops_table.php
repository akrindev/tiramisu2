<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDropsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drops', function (Blueprint $table) {
            $table->increments('id');
          	$table->integer('drop_type_id');
          	$table->string('name');
          	$table->integer('proses')->nullable();
          	$table->integer('sell')->nullable();
          	$table->text('note')->nullable();
          	$table->string('picture')->nullable();
        });

        Schema::create('drop_types', function (Blueprint $table) {
            $table->increments('id');
          	$table->string('name');
          	$table->string('url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('drops');
    }
}