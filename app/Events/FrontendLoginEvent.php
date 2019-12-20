<?php

namespace App\Events;

use App\Models\User\FrontendUser;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Class FrontendLoginEvent
 * @package App\Events
 */
class FrontendLoginEvent
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    /**
     * @var FrontendUser user model.
     */
    public $user;

    /**
     * FrontendLoginEvent constructor.
     * @param FrontendUser $user User model.
     */
    public function __construct(FrontendUser $user)
    {
        $this->user = $user;
    }
}
