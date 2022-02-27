<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use App\Models\ChatRoom;

// class User extends Authenticatable
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    // protected $appends = ['id','first_name'];
    // public function getIdAttribute()
    // {
    //     return encrypt($this->id);
    //     // return "test";
    // }
    // public function getFirstNameAttribute($value)
    // {
    //     return ucfirst($value);
    // }
    public function get_user1_rooms()
    {
        return $this->hasMany(ChatRoom::class,'user1','id');
    }
    public function get_user2_rooms()
    {
        return $this->hasMany(ChatRoom::class,'user2','id');
    }
    public function get_rooms()
    {
        return $this->get_user1_rooms->merge($this->get_user2_rooms);
    }
}
