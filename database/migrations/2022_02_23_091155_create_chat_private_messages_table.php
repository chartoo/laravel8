<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatPrivateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_private_messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('chat_room_id');
            $table->foreign('chat_room_id')->references('id')->on('chat_rooms');
            $table->longText('message')->nullable();
            $table->integer('mention_message_id')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chat_private_messages');
    }
}
