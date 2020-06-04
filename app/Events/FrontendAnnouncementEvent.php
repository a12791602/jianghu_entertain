<?php

namespace App\Events;

use Carbon\Carbon;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Class AnnouncementEvent
 * @package App\Events
 */
class FrontendAnnouncementEvent implements ShouldBroadcast
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
     * @var string $type
     */
    private $type;

    /**
     * 广播数据.
     *
     * @var array $data
     */
    private $data;

    /**
     * Create a new event instance.
     *
     * @param string $type 消息类型.
     * @param array  $data 广播数据.
     */
    public function __construct(
        string $type,
        array $data = []
    ) {
        $this->platformSign = getCurrentPlatformSign();
        $this->type         = $type;
        $this->data         = $data;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel
     */
    public function broadcastOn(): Channel
    {
        $channel = 'frontend.announcement.' . $this->platformSign;
        $channel = new Channel($channel);
        return $channel;
    }

    /**
     * The event's broadcast name.
     *
     * @return string
     */
    public function broadcastAs(): string
    {
        return 'frontend.announcement';
    }

    /**
     * 指定广播数据.
     *
     * @return mixed[]
     */
    public function broadcastWith(): array
    {
        return [
                'type'         => $this->type,
                'data'         => $this->data,
                'current_time' => Carbon::now()->toDateTimeString(),
               ];
    }
}
