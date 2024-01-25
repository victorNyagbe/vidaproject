<?php

namespace App\Listeners;

use App\Events\sendInvitationMailForCollabEvent;
use App\Mail\SendInvitationForCollabMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class sendInvitationMailForCollabListener
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
     * @param  \App\Events\sendInvitationMailForCollabEvent  $event
     * @return void
     */
    public function handle(sendInvitationMailForCollabEvent $event)
    {
        $recipientEmail = $event->data['recipientEmail'];

        // Mail::to('lastundertaker18@gmail.com')->send(new SendInvitationForCollabMail($event->data));

        Mail::to($recipientEmail)->send(new SendInvitationForCollabMail($event->data));

    }
}
