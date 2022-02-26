<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatPrivateMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'chat_room_id',
        'message',
        'mention_message_id'
    ];
}
