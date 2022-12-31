<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempDropsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_drops', function (Blueprint $table) {
            $table->id();
            $table->integer('drop_id')->nullable();
            $table->integer('drop_type_id');
            $table->integer('user_id')->nullable();
            $table->tinyInteger('approved')->default(0);
            $table->string('name');
            $table->string('name_en');
            $table->json('note')->nullable();
            $table->string('picture')->nullable();
            $table->string('fullimage')->nullable();
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
        Schema::dropIfExists('temp_drops');
    }
}
