<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVotesToWordsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('words', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('words', function (Blueprint $table) {
        });
    }
}
