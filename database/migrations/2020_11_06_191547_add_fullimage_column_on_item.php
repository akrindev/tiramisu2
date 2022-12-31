<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFullimageColumnOnItem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('drops', function (Blueprint $table) {
            $table->string('fullimage')->after('picture')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('drops', 'fullimage')) {
            Schema::table('drops', function (Blueprint $table) {
                $table->dropColumn(['fullimage']);
            });
        }
    }
}
