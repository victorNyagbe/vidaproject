<?php

namespace App\Providers;

use App\Events\SessionExpired;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use App\Listeners\HandleSessionExpiration;
use Illuminate\Session\Events\SessionEnding;
use App\Events\sendInvitationMailForClientEvent;
use App\Events\sendInvitationMailForCollabEvent;
use App\Listeners\sendInvitationMailForClientListener;
use App\Listeners\sendInvitationMailForCollabListener;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        sendInvitationMailForCollabEvent::class => [
            sendInvitationMailForCollabListener::class,
        ],

        sendInvitationMailForClientEvent::class => [
            sendInvitationMailForClientListener::class,
        ],

        SessionExpired::class => [
            HandleSessionExpiration::class,
        ],

        'Illuminate\Session\Events\SessionEnding' => [
            'App\Observers\SessionEndingObserver@ending',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
