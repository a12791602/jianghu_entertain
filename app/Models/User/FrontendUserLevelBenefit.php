<?php

namespace App\Models\User;

use App\Models\BaseAuthModel;

/**
 * 会员等级权益
 */
class FrontendUserLevelBenefit extends BaseAuthModel
{

    /**
     * 晋级礼金已领取
     */
    public const PROMOTION_GIFT_RECEIVED = 1;

    /**
     * 周礼金已领取
     */
    public const WEEKLY_GIFT_RECEIVED = 1;

    /**
     * @var array $guarded
     */
    protected $guarded = ['id'];
}
