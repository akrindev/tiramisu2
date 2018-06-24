<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ForumsIsi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forums_isi', function(Blueprint $table) {
          	$table->charset = 'utf8mb4';
          	$table->collation = 'utf8mb4_unicode_ci';


        	$table->increments('id');
          	$table->integer('user_id');
          	$table->integer('parent_id');
          	$table->longText('isi');
          	$table->timestamps();
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
        Schema::dropIfExists('forums_isi');
    }
}