<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Class SystemEmailEvent
 *
 * @package App\Events
 */
class SystemEmailEvent
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    /**
     * 邮件id
     *
     * @var integer
     */
    public $emailId;

    /**
     * SystemEmailEvent constructor.
     *
     * @param integer $emailId EmailId.
     */
    public function __construct(int $emailId)
    {
        $this->emailId = $emailId;
    }
}
