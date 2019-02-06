<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChoicesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('choices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('content');
            $table->integer('word_id')->unsigned();
            $table->foreign('word_id')->references('id')->on('words');
            $table->boolean('correct');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('choices');
    }
}
