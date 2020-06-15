<?php

namespace App\Http\SingleActions\Frontend\H5\Recharge;

use App\Http\SingleActions\MainAction;
use App\Models\User\UsersRechargeOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

/**
 * Class BaseAction
 * @package App\Http\SingleActions\Frontend\H5\Recharge
 */
class BaseAction extends MainAction
{

    /**
     * @var \Illuminate\Redis\Connections\Connection $cache Cache instance.
     */
    protected $cache;

    /**
     * @var string $order_key Order key.
     */
    protected $order_key;

    /**
     * @var \Illuminate\Support\Collection $order_item Order item.
     */
    protected $order_item;

    /**
     * @param Request $request Request.
     * @throws \Exception Exception.
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $platform_sign    = $this->currentPlatformEloq->sign;
        $cache            = Redis::connection();
        $this->cache      = $cache;
        $this->order_key  = $platform_sign . ':frontend_user_' . $this->user->id . ':top_up_order:';
        $range_key        = $this->cache->keys($this->order_key . '*');
        $cache_prefix     = config('database.redis.options.prefix');
        $this->order_item = collect($range_key)->map(
            static function ($order_key) use ($cache, $cache_prefix): UsersRechargeOrder {
                $order_key = str_replace($cache_prefix, '', $order_key);
                $item      = $cache->get($order_key);
                return unserialize($item);
            },
        );
    }
}
