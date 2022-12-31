<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvatarListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avatar_lists', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('title_en');
            $table->tinyInteger('type')->default(1);
            $table->integer('rate')->default(1);
            $table->string('value')->default('1.00');
            $table->string('image');
            $table->timestamps();
        });

        Schema::create('avatar_avatar_lists', function (Blueprint $table) {
            $table->id();
            $table->integer('avatar_id');
            $table->integer('avatar_list_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('avatar_lists');
        Schema::dropIfExists('avatar_avatar_lists');
    }
}
