<?php

namespace App\Events;

use App\Services\FactoryService;
use Carbon\Carbon;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
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
     * @param string $platformSign 所属平台.
     * @param string $messageType  消息类型.
     * @param string $message      消息.
     * @param array  $data         广播数据.
     */
    public function __construct(
        string $platformSign,
        string $messageType,
        string $message = '',
        array $data = []
    ) {
        $const              = FactoryService::getInstence()->generateService('constant');
        $this->platformSign = $platformSign;
        $this->messageType  = $messageType;
        $this->message      = $message;
        if (empty($message) && isset($const::NOTICE_MESSAGES[$messageType])) {
            $this->message = $const::NOTICE_MESSAGES[$messageType];
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
        $channel = 'merchant.notice.' . $this->platformSign;
        $channel = new Channel($channel);
        return $channel;
    }

    /**
     * 事件的广播名称.
     *
     * @return string
     */
    public function broadcastAs(): string
    {
        return 'notice';
    }

    /**
     * 指定广播数据.
     *
     * @return mixed[]
     */
    public function broadcastWith(): array
    {
        $data = [
                 'message_type' => $this->messageType,
                 'message'      => $this->message,
                 'data'         => $this->data,
                 'current_time' => Carbon::now()->toDateTimeString(),
                ];
        return $data;
    }
}
