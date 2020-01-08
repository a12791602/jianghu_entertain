<?php

namespace App\Models\Order;

use App\Models\BaseModel;
use App\Models\Finance\SystemFinanceOnlineInfo;
use App\Models\User\FrontendUser;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class UsersRechargeOrder
 * @package App\Models\Order
 */
class UsersRechargeOrder extends BaseModel
{
    
    /**
     * @var array
     */
    protected $guarded = ['id'];

    public const STATUS_INIT    = 0; //初始化的订单状态 线下订单代表 审核中 线上订单代表 未支付
    public const STATUS_SUCCESS = 1; //成功的订单状态 线下订单代表 审核通过 线上订单代表 已支付
    public const STATUS_REFUSE  = -1; //拒绝的订单状态 线下订单代表 审核拒绝 此状态线下仅有
    public const STATUS_EXPIRED = -2; //过期的订单状态

    public const EXPIRED = 15; //订单有效期 单位分钟

    /**
     * @return HasOne
     */
    public function onlineInfo(): HasOne
    {
        $object = $this->hasOne(SystemFinanceOnlineInfo::class, 'id', 'finance_channel_id');
        return $object;
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        $object = $this->belongsTo(FrontendUser::class, 'user_id', 'id');
        return $object;
    }
}
