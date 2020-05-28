<?php

namespace App\Lib\Constant;

/**
 * Class JHHYConstant
 * @package App\Lib\Constant
 */
class JHHYCnst
{
    //pc端
    public const DEVICE_PC = 1;
    //h5端
    public const DEVICE_H5 = 2;
    //app端
    public const DEVICE_APP = 3;
    //Android
    public const DEVICE_APK = 4;
    public const GUARD_H5   = 'frontend-h5';
    public const GUARD_APP  = 'frontend-mobile';
    //启用状态
    public const STATUS_OPEN = 1;
    //禁用状态
    public const STATUS_DISABLE = 0;
    //邮件通知
    public const NOTICE_OF_EMAIL = 'notice_of_email';
    //线下入款通知
    public const NOTICE_OF_RECHARGE_OFF = 'notice_of_recharge_off';
    //线上入款通知
    public const NOTICE_OF_RECHARGE_ON = 'notice_of_recharge_on';
    //出款审核通知
    public const NOTICE_OF_WITHDRAW_AUDIT = 'notice_of_withdraw_audit';
    //出款订单通知
    public const NOTICE_OF_WITHDRAW = 'notice_of_withdraw';
    //会员余额更新通知
    public const NOTICE_OF_BALANCE_UPDATE = 'notice_of_balance_update';
    //系统通知
    public const NOTICE_OF_SYSTEM = 'notice_of_system';

    public const NOTICE_MESSAGES = [
                                    self::NOTICE_OF_EMAIL          => '您有新的邮件,请注意查看!',
                                    self::NOTICE_OF_RECHARGE_OFF   => '您有新的线下入款订单,请注意查看!',
                                    self::NOTICE_OF_RECHARGE_ON    => '您有新的线上入款订单,请注意查看!',
                                    self::NOTICE_OF_WITHDRAW_AUDIT => '您有新的出款审核订单,请注意查看!',
                                    self::NOTICE_OF_WITHDRAW       => '您有新的出款订单,请注意查看!',
                                   ];

    public const FRONTEND    = 'frontend';
    public const MERCHANT    = 'merchant';
    public const HEADQUARTER = 'headquarter';
    //在线
    public const ONLINE = 1;
    //离线
    public const OFFLINE = 0;
    // 滚动公告
    public const ANNOUNCEMENT_SCROLL = 'announcement_scroll';
    // 系统公告
    public const ANNOUNCEMENT_SYSTEM = 'announcement_system';
    // 登录弹窗公告
    public const ANNOUNCEMENT_SIGN_IN = 'announcement_sign_in';
}
