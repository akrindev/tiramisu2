<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNameEnColumnOnDropAndMonster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('drops', function (Blueprint $table) {
            $table->string('name_en')->after('name')->nullable();
        });

        Schema::table('monsters', function (Blueprint $table) {
            $table->string('name_en')->after('name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('drops', 'name_en')) {
            Schema::table('drops', function (Blueprint $table) {
                $table->dropColumn(['name_en']);
            });
        }

        if (Schema::hasColumn('monsters', 'name_en')) {
            Schema::table('monsters', function (Blueprint $table) {
                $table->dropColumn(['name_en']);
            });
        }
    }
}
