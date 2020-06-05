<?php

namespace App\Events;

use Carbon\Carbon;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Class FrontendDynamicInfoEvent
 * @package App\Events
 */
class FrontendDynamicInfoEvent implements ShouldBroadcast
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    /**
     * 会员uid.
     *
     * @var string $user_guid
     */
    private $user_guid;

    /**
     * 平台.
     *
     * @var string $platformSign
     */
    private $platformSign;

    /**
     * 广播数据.
     *
     * @var array $data
     */
    private $data;

    /**
     * Create a new event instance.
     *
     * @param string $user_guid 会员UID.
     * @param array  $data      广播数据.
     */
    public function __construct(
        string $user_guid,
        array $data = []
    ) {
        $this->platformSign = getCurrentPlatformSign();
        $this->user_guid    = $user_guid;
        $this->data         = $data;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel
     */
    public function broadcastOn(): Channel
    {
        $channel = 'frontend.dynamic.' . $this->platformSign . '.' . $this->user_guid;
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
        return 'frontend.dynamic.info';
    }


    /**
     * 指定广播数据.
     *
     * @return mixed[]
     */
    public function broadcastWith(): array
    {
        return [
                'data'         => $this->data,
                'current_time' => Carbon::now()->toDateTimeString(),
               ];
    }
}
