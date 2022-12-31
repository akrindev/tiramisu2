<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmblemListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emblem_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('emblem_id');
            $table->string('name');
            $table->string('body');
            $table->string('reward');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emblem_lists');
    }
}
