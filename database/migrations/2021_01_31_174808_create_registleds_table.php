<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistledsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registleds', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('drop_id')->references('id')->on('drops');
            $table->integer('max_level')->nullable()->default(1);
            $table->string('recommended_lv')->nullable();
            $table->string('box')->nullable();
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
        Schema::dropIfExists('registleds');
    }
}
