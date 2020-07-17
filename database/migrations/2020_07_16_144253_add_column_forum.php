<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnForum extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('forums', function(Blueprint $table){
            $table->bigInteger('forum_category_id')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(Schema::hasColumn('forums', 'forum_category_id')) {
        	Schema::table('forums', function (Blueprint $table) {
        		$table->dropColumn(['forum_category_id']);
        	});
      	}
    }
}