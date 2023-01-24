<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // add soft deletes on drops
        Schema::table('drops', function (Blueprint $table) {
            $table->softDeletes();
        });
        // add soft deletes on monsters
        Schema::table('monsters', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // drop soft deletes on drops
        Schema::table('drops', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        // drop soft deletes on monsters
        Schema::table('monsters', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
