<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyCookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      //drop table cookings
        Schema::dropIfExists('cookings');
      // then recreate it
        Schema::create('cookings', function (Blueprint $table) {
          	$table->increments('id');
          	$table->string('name')->nullable();
          	$table->string('buff');
          	$table->integer('stat');
          	$table->integer('pt')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cookings');
    }
}