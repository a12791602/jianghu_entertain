<?php

namespace App\Models\Systems;

use App\Models\BaseModel;

/**
 * 系统白名单配置
 * Class SystemIpWhiteList
 * @package App\Models\Systems
 */
class SystemIpWhiteList extends BaseModel
{

    /**
     * IP白名单 厂商类型
     */
    public const WHITELIST_IP_TYPE_VENDOR = 1;

    /**
     * IP白名单 支付类型
     */
    public const WHITELIST_IP_TYPE_FINANCE = 2;

    /**
     * @var array $guarded
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['ips' => 'array'];
}
