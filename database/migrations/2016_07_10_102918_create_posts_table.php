<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->text('text');
            $table->integer('user_id')->unsigned();
            $table->integer('first_changed_by')->unsigned()->nullable();
            $table->integer('last_changed_by')->unsigned()->nullable();
            $table->integer('news_id')->unsigned()->nullable();
            $table->string('status', 50)->nullable();
            $table->timestamps();

            /* Foreign Keys */
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('first_changed_by')->references('id')->on('admins');
            $table->foreign('last_changed_by')->references('id')->on('admins');
            $table->foreign('news_id')->references('id')->on('news');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('posts');
    }
}
