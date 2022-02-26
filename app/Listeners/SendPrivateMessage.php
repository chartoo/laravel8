<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

use App\Models\ChatPrivateMessage;
use App\Events\ChatPrivateMessage as ChatPrivateMessageEvent;

class SendPrivateMessage
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(ChatPrivateMessageEvent $event)
    {
        $room_code=explode('-',base64_decode($event->room_code));
        $room_id=$room_code[0];
        ChatPrivateMessage::create([
            'chat_room_id'=>$room_id,
            'message'=>json_encode($event->histories),
            'mention_message_id'=>0
        ]);
    }
}
