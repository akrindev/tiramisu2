<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNpcsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('npcs', function (Blueprint $table) {
            $table->increments('id');
          	$table->string('name');
          	$table->integer('map_id');
          	$table->string('picture')->nullable();
        });

      	Schema::create('npc_quests', function (Blueprint $table) {
          	$table->increments('id');
          	$table->integer('npc_id');
          	$table->string('name');
          	$table->integer('level')->nullable(); // level requirement
          	$table->integer('exp')->nullable(); // reward exp
          	$table->text('detail')->nullable(); // depends
        });

      	Schema::create('npc_tujuan', function (Blueprint $table) {
          	$table->increments('id');
          	$table->integer('npc_quest_id');
          	$table->integer('defeat')->default(2); // 1 => defeat, 2 => collect
          	$table->integer('drop_id')->nullable(); // if null we will show defeat mons
          	$table->integer('monster_id')->nullable(); // nah
          	$table->integer('many')->default(1); // how many requirements to defeat or collect

        });

      	Schema::create('npc_rewards', function (Blueprint $table) {
          	$table->increments('id');
          	$table->integer('npc_quest_id');
          	$table->integer('drop_id');
          	$table->integer('many')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('npcs');
        Schema::dropIfExists('npc_quests');
        Schema::dropIfExists('npc_tujuan');
        Schema::dropIfExists('npc_rewards');
    }
}