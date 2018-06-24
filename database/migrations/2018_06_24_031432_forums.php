<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Forums extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forums', function(Blueprint $table) {
          	$table->charset = 'utf8mb4';
          	$table->collation = 'utf8mb4_unicode_ci';


        	$table->increments('id');
          	$table->integer('user_id');
          	$table->string('judul');
          	$table->string('slug');
          	$table->string('tags');
          	$table->integer('views');
          	$table->boolean('pinned')->default(0);
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
        Schema::dropIfExists('forums');
    }
}