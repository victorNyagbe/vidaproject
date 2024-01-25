<?php

namespace App\Observers;

use Illuminate\Support\Facades\DB;

class SessionEndingObserver
{
    public function ending($event)
    {
        $userId = $event->userId;
        DB::table('connected_sessions')->where('user_id', $userId)->delete();
    }
}
