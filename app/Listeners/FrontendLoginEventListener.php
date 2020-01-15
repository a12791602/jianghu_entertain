<?php

namespace App\Listeners;

use App\Events\FrontendLoginEvent;
use App\Models\User\UsersLoginLog;
use Jenssegers\Agent\Agent;

/**
 * Class FrontendLoginEventListener
 * @package App\Listeners
 */
class FrontendLoginEventListener
{

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  FrontendLoginEvent $event Event.
     * @return void
     */
    public function handle(FrontendLoginEvent $event): void
    {
        $agent                     = new Agent();
        $data                      = $event->user->only(
            [
             'uid',
             'mobile',
             'platform_sign',
             'last_login_ip',
             'last_login_time',
             'last_login_ip',
            ],
        );
        $data['last_login_device'] = $agent->device();
        UsersLoginLog::insert($data);
    }
}
