<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('provider_id');
          	$table->string('username')->nullable();
            $table->text('link')->nullable();
          	$table->text('biodata');
          	$table->boolean('banned')->default(0);
          	$table->string('ign');
          	$table->string('alamat');
          	$table->enum('role',['admin','staff','member'])->default('member');
          	$table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}