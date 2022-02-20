<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\NewsletterSubscribe;
use App\Models\User;
use App\Notifications\NewsletterNotification;

class NewsLettersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('newsletters.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate=$request->validate([
            'email'=>'required|email|unique:newsletters,email'
        ]);
        event(new NewsletterSubscribe($request->input('email')));
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function notify()
    {
        $user=User::first();
        $notifyData=[
            'body'=>'You received a notification message from our pleasure',
            'text'=>'View Notifications',
            'url'=>url('/newsletters'),
            'thankyou'=>'Thanks yours interest, this noti wll valid for 14 days'
        ];
        $user->notify(new NewsletterNotification($notifyData));

        return redirect('/newsletters/create');
    }
}
