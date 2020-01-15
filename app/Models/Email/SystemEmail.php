<?php

namespace App\Models\Email;

use App\Models\BaseModel;

/**
 * Class SystemEmail
 *
 * @package App\Models\Email
 */
class SystemEmail extends BaseModel
{

    /**
     * @var array
     */
    protected $guarded = ['id'];
    /**
     * 立即发送
     *
     */
    public const IS_TIMING_NO = 0;
    /**
     * 延时发送
     *
     */
    public const IS_TIMING_YES = 1;
    /**
     * 已发送
     *
     */
    public const IS_SEND_YES = 1;
    /**
     * 未发送
     *
     */
    public const IS_SEND_NO = 0;
    /**
     * 发送者类型 总后台
     *
     */
    public const SENDER_TYPE_HEADQUARTERS = 1;
    /**
     * 发送者类型 运营商
     *
     */
    public const SENDER_TYPE_MERCHANT = 2;
    /**
     * 发送者类型 玩家
     *
     */
    public const SENDER_TYPE_PLAYER = 3;
}
