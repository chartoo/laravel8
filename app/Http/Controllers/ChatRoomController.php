<?php

namespace App\Http\Controllers;

use App\Models\ChatRoom;
use App\Models\User;
use App\Events\ChatPrivateMessage;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use View;

class ChatRoomController extends Controller
{
    public $rooms;
    public $users;
    public function __construct() {
        $this->rooms=ChatRoom::all();
        $this->users=User::all();
        View::share(['rooms'=>$this->rooms,'users'=>$this->users]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $current_id=Auth::user()->id;
            $room=ChatRoom::where(function ($query) use ($current_id) {
                $query->where('user1', '=', $current_id)
                      ->orWhere('user2', '=', $current_id);
            })->first();
        if($room && !empty($room)){
            $to_user_id=$room->user1==$current_id?$room->user2:$room->user1;
            return redirect('/chat-rooms/'.base64_encode($to_user_id));
        }
        return view('chatrooms.index',[
            'current_id'=>$current_id,
            'current_code'=>base64_encode($current_id),
            'room_code'=>null,
            'user_code'=>null,
            'user_name'=>null,
            'user_email'=>null,
            'histories'=>[],
            'related_users'=>[]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ChatRoom  $chatRoom
     * @return \Illuminate\Http\Response
     */
    public function show($userCode)
    {
        $auth=Auth::user();
        $user=User::find(base64_decode($userCode));
        $room=ChatRoom::where(['user1'=>$user->id,'user2'=>$auth->id])->first();
        if(!$room){
            $room=ChatRoom::firstOrCreate(
                ['user1'=>$auth->id,'user2'=>$user->id],
                ['name'=>$user->name]
            );
        }
        
        $histories=$room->private_messages()->pluck('message');
        $room_code=base64_encode($room->id.'-'.$room->name);
        $current_id=$auth->id;
        $rooms=User::find($current_id)->get_rooms();
        $related_users=array();
        foreach ($rooms as $key => $room) {
           if($room->user1!=$current_id) array_push($related_users,$room->user_one);
           if($room->user2!=$current_id) array_push($related_users,$room->user_two);
        }
        return view('chatrooms.index',[
            'current_id'=>$current_id,
            'current_code'=>base64_encode($current_id),
            'room_code'=>$room_code,
            'user_code'=>$userCode,
            'user_name'=>$user->name,
            'user_email'=>$user->email,
            'histories'=>$histories,
            'related_users'=>$related_users
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ChatRoom  $chatRoom
     * @return \Illuminate\Http\Response
     */
    public function edit(ChatRoom $chatRoom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ChatRoom  $chatRoom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ChatRoom $chatRoom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ChatRoom  $chatRoom
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChatRoom $chatRoom)
    {
        //
    }
    /**
     * Chatting another in a room 
     */
    public function entry($user_code=null,$room_code=null,Request $request)
    {
        $data=$request->all();
        $from=Auth::user()->id;
        $to=base64_decode($user_code);
        event(new ChatPrivateMessage($room_code,$user_code,[
            'from'=>$from,
            'to'=>$to,
            'message'=>[
                'text'=>$data['message'],
                'time'=>date("F j, g:i a")
                ]
            ]));
        return true;
    }
}
