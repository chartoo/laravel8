<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Events\NewsletterSubscribe;
use App\Models\Newsletter;
use App\Mail\NewsletterMessage;

class NewsletterSubscription
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
    public function handle(NewsletterSubscribe $event)
    {
        Newsletter::create([
            'email' => $event->email
        ]);

        Mail::to($event->email)->send(new NewsletterMessage());
    }
}
