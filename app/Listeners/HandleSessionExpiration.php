<?php

namespace App\Listeners;

use App\Events\SessionExpired;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleSessionExpiration
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
     * @param  \App\Events\SessionExpired  $event
     * @return void
     */
    public function handle(SessionExpired $event)
    {
        $userId = $event->userId;

        dd($userId);

        DB::table('connected_sessions')->where('user_id', $userId)->delete();

    }
}
