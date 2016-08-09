<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('admin_id')->unsigned();
            $table->string('about', 10000);
            $table->string('location');
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('linkedIn')->nullable();
            $table->string('googlePlus')->nullable();
            $table->timestamps();

            /* Foreign Keys */
            $table->foreign('admin_id')->references('id')->on('admins');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('admin_details');
    }
}
