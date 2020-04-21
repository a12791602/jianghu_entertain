<?php

namespace App\Models\Notification;

use App\Models\BaseModel;

/**
 * Class MerchantNotification
 * @package App\Models\Notification
 */
class MerchantNotificationStatistic extends BaseModel
{

    // 计数清零
    public const COUNT_ZERO = 0;

    // 消息类型 邮件
    public const EMAIL = 'email';

    // 消息类型 线上入款
    public const ONLINE_TOP_UP = 'online_top_up';

    // 消息类型 线下入款
    public const OFFLINE_TOP_UP = 'offline_top_up';

    // 消息类型 出款订单
    public const WITHDRAWAL_ORDER = 'withdrawal_order';

    // 消息类型 出款订单审核
    public const WITHDRAWAL_REVIEW = 'withdrawal_review';

    /**
     * @var mixed[]
     */
    protected $guarded = ['id'];
}
