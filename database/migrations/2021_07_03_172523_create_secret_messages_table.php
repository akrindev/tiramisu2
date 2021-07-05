<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSecretMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('secret_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->text('message');
            $table->boolean('privacy')->default(1);
            $table->integer('parent_id')->nullable();  // for reply
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
        Schema::dropIfExists('secret_messages');
    }
}
