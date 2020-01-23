<?php

namespace App\Models\Email;

use App\Models\BaseModel;

/**
 * Class SystemEmailReceiver
 *
 * @package App\Models\Email
 */
class SystemEmailReceiver extends BaseModel
{

    /**
     * 接收者类型 总后台
     *
     */
    public const RECEIVER_TYPE_HEADQUARTERS = 1;
    /**
     * 接收者类型 运营商
     *
     */
    public const RECEIVER_TYPE_MERCHANT = 2;
    /**
     * 接收者类型 玩家
     *
     */
    public const RECEIVER_TYPE_PLAYER = 3;

    /**
     * @var array
     */
    protected $guarded = ['id'];
}
