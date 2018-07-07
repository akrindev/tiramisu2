<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->increments('id');
          	$table->integer('user_id');
          	$table->string('nama_barang');
          	$table->integer('harga');
          	$table->text('deskripsi');
          	$table->text('gambar');
          	$table->integer('views')->default(0);
          	$table->string('slug');
          	$table->integer('cat_id');
          	$table->integer('laku')->default(0);
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
        Schema::dropIfExists('shops');
    }
}