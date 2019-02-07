<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPaidToAnswers extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('answers', function (Blueprint $table) {
            $table->foreign('word_id')->references('id')->on('words');
            $table->foreign('choice_id')->references('id')->on('choices');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('answers', function (Blueprint $table) {
        });
    }
}
