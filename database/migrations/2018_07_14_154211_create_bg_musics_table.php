<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBgMusicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bg_musics', function (Blueprint $table) {
            $table->increments('id');
          	$table->string('title');
          	$table->string('slug');
          	$table->string('video_id');
          	$table->string('channel_title');
          	$table->string('channel_id');
          	$table->dateTime('pada');
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
        Schema::dropIfExists('bg_musics');
    }
}