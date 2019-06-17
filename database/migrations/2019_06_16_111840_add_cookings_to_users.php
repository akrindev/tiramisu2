<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCookingsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasColumn('users', 'birthday')) {
          Schema::table('users', function (Blueprint $table) {
        	$table->dropColumn('birthday');
          });
        }

        Schema::table('users', function (Blueprint $table) {
          $table->integer('cooking_id')->nullable()->after('changed');
          $table->integer('cooking_level')->nullable()->after('cooking_id');
          $table->tinyInteger('visibility')->default(0)->after('cooking_level');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
        	$table->dropColumn(['cooking_id', 'cooking_level', 'visibility']);
        });
    }
}