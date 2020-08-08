<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormulasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formulas', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('note')->nullable();
            $table->text('final_step');
            $table->json('body');
            $table->integer('starting_pot');
            $table->integer('highest_mats');
            $table->enum('type', ['w', 'a'])->default('w');
            $table->integer('success_rate');
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
        Schema::dropIfExists('formulas');
    }
}