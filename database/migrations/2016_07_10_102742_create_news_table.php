<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('author_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->text('text');
            $table->string('avatar_picture')->nullable();
            $table->boolean('ismainnew')->default(false);
            //$table->boolean('isslidernew')->default(false);
            $table->string('language', 2);
            $table->integer('views');
            $table->integer('shares');
            $table->integer('likes');
            $table->timestamps();

            /* Foregin Keys */
            $table->foreign('author_id')->references('id')->on('admins');
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('news');
    }
}
