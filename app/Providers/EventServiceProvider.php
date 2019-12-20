<?php

namespace App\Providers;

use App\Events\FrontendLoginEvent;
use App\Events\SystemEmailEvent;
use App\Listeners\FrontendLoginEventListener;
use App\Listeners\SystemEmailEventListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

/**
 * Class EventServiceProvider
 *
 * @package App\Providers
 */
class EventServiceProvider extends ServiceProvider
{

    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        SystemEmailEvent::class => [
            SystemEmailEventListener::class,
        ],
        FrontendLoginEvent::class => [
            FrontendLoginEventListener::class,
        ],
    ];
}
