<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForumsDescsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forums_descs', function (Blueprint $table) {
          	$table->charset = 'utf8mb4';
          	$table->collation = 'utf8mb4_unicode_ci';

            $table->increments('id');
          	$table->integer('user_id');
          	$table->integer('forum_id');
          	$table->longText('body');
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
        Schema::dropIfExists('forums_descs');
    }
}