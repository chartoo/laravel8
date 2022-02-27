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
        if($this->rooms &&  $this->rooms[0]->user2)
        return redirect('/chat-rooms/'.base64_encode($this->rooms[0]->user2));
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
        return view('chatrooms.index',[
            'current_id'=>$current_id,
            'current_code'=>base64_encode($current_id),
            'room_code'=>$room_code,
            'user_code'=>$userCode,
            'user_name'=>$user->name,
            'user_email'=>$user->email,
            'histories'=>$histories
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
