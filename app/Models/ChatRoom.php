<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\ChatPrivateMessage;

class ChatRoom extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user1',
        'user2',
    ];
    public function user_one()
    {
        return $this->belongsTo(User::class,'user1','id');
    }
    public function user_two()
    {
        return $this->belongsTo(User::class,'user2','id');
    }
    public function private_messages()
    {
        return $this->hasMany(ChatPrivateMessage::class,'chat_room_id','id');
    }
}
