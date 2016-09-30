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
            $table->integer('author_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->string('title');
            $table->string('short_description', 400);
            $table->text('text');
            $table->boolean('ismainnew')->default(false);
            $table->string('video_url')->nullable();
            $table->string('avatar_picture');
            $table->string('media_author');
            $table->string('tags');
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
