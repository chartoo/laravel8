<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\MessageNotification;

class MessageNotificationsController extends Controller
{
    public function make_event()
    {
        return view('messagenotifications.make-event');
    }
    public function send_make_event(Request $request)
    {
        $data=$request->all();
        event(new MessageNotification(['title'=>$data['title'],'body'=>$data['message'],'time'=>date("F j, g:i a")]));
        return true;
    }
    public function listen_event(Request $request)
    {
        return view('messagenotifications.listen-event');
    }
}
