<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdsensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('adsenses', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('admin_id')->unsigned();

            $table->string('title');
            $table->string('location', 15);
            $table->text('code');

            $table->boolean('published')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('adsenses');
    }
}
