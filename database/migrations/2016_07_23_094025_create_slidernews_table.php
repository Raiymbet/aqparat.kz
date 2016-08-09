<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlidernewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slidernews', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('new_id')->unsigned();
            $table->timestamps();

            /* Foregin Keys */
            $table->foreign('new_id')->references('id')->on('news');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('slidernews');
    }
}
