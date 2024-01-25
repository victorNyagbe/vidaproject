<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\SendInvitationForClientMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\sendInvitationMailForClientEvent;

class sendInvitationMailForClientListener
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
     * @param  \App\Events\sendInvitationMailForClientEvent  $event
     * @return void
     */
    public function handle(sendInvitationMailForClientEvent $event)
    {
        $recipientEmail = $event->data['recipientEmail'];

        // Mail::to('gomezfelix310@gmail.com')->send(new SendInvitationForClientMail($event->data));

        Mail::to($recipientEmail)->send(new SendInvitationForClientMail($event->data));
    }
}
