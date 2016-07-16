<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserConversationMapping extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('UserConversationMapping', function (Blueprint $table) {
            $table->integer('conversation_id')->unsigned()->nullable();
            $table->foreign('conversation_id')->references('id')->on('conversation');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('user');
            
            $table->unique(['user_id','conversation_id']);

            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('UserConversationMapping', function ($table) {
            $table->dropForeign('UserConversationMapping_conversation_id_foreign');
            $table->dropForeign('UserConversationMapping_user_id_foreign');
        });
        Schema::drop('UserConversationMapping');
    }
}
