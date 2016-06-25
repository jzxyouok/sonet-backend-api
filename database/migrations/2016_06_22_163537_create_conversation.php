<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConversation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conversation', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('created_at');
            $table->integer('user1_id')->unsigned()->nullable();
            $table->foreign('user1_id')->references('id')->on('user');
            $table->integer('user2_id')->unsigned()->nullable();
            $table->foreign('user2_id')->references('id')->on('user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('conversation');
    }
}
