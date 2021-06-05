<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuildsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guilds', function (Blueprint $table) {
            $table->id();
            $table->integer('manager_id');
            $table->string('name');
            $table->string('logo');
            $table->text('description')->nullable();
            $table->integer('level');
            $table->timestamps();
        });

        Schema::create('user_guild', function (Blueprint $table) {
            $table->integer('user_id');
            $table->integer('guild_id');
            $table->enum('role', ['ketua', 'wakil', 'inviter']);
            $table->integer('manager_id')->nullable();
            $table->tinyInteger('accept')->default(0);
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
        Schema::dropIfExists('guilds');
        Schema::dropIfExists('user_guild');
    }
}
