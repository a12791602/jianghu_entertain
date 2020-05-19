<?php

namespace App\Events;

use App\Lib\Constant\JHHYCnst;
use Carbon\Carbon;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Class PlatformNoticeEvent
 * @package App\Events
 */
class PlatformNoticeEvent implements ShouldBroadcast
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    /**
     * 平台.
     *
     * @var string $platformSign
     */
    private $platformSign;

    /**
     * 消息类型.
     *
     * @var string $messageType
     */
    private $messageType;

    /**
     * 消息.
     *
     * @var string $message
     */
    private $message;

    /**
     * 广播数据.
     *
     * @var array $data
     */
    private $data;

    /**
     * Create a new event instance.
     *
     * @param string $messageType 消息类型.
     * @param string $message     消息.
     * @param array  $data        广播数据.
     */
    public function __construct(
        string $messageType,
        string $message = '',
        array $data = []
    ) {
        $this->platformSign = getCurrentPlatformSign();
        $this->messageType  = $messageType;
        $this->message      = $message;
        if (empty($message) && isset(JHHYCnst::NOTICE_MESSAGES[$messageType])) {
            $this->message = JHHYCnst::NOTICE_MESSAGES[$messageType];
        }
        $this->data = $data;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel
     */
    public function broadcastOn(): Channel
    {
        $channel = 'merchant_notice_' . $this->platformSign;
        $channel = new PrivateChannel($channel);
        return $channel;
    }



    /**
     * 指定广播数据.
     *
     * @return mixed[]
     */
    public function broadcastWith(): array
    {
        return [
                'message_type' => $this->messageType,
                'message'      => $this->message,
                'data'         => $this->data,
                'current_time' => Carbon::now()->toDateTimeString(),
               ];
    }
}
