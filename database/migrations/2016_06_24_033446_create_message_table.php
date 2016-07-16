<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message', function (Blueprint $table) {
            $table->increments('id');
            $table->string('text');
            $table->timestamp('created_at');
            $table->integer('conversation_id')->unsigned();
            $table->foreign('conversation_id')->references('id')->on('conversation');
            $table->integer('sender_id')->unsigned();
            $table->foreign('sender_id')->references('id')->on('user');
            $table->string('user_name');
            //$table->foreign('receiver_id')->references('id')->on('user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('message', function ($table) {
            $table->dropForeign('message_conversation_id_foreign');
            $table->dropForeign('message_sender_id_foreign');
        });
        Schema::drop('message');
    }
}
