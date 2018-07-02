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

          	$table->charset = 'utf8mb4';
          	$table->collation = 'utf8mb4_unicode_ci';


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
          	$table->enum('gender',['cowok','cewek','hode'])->default('hode');
          	$table->date('birthday')->nullable();
          	$table->enum('role',['admin','staff','member'])->default('member');
          	$table->boolean('changed')->default(0);
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