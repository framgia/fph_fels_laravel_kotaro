<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVotesToLessonsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('lessons', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('lessons', function (Blueprint $table) {
        });
    }
}
