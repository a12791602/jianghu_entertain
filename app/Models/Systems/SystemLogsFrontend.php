<?php

namespace App\Models\Systems;

use App\Models\BaseModel;

/**
 * 前台系统日志
 */
class SystemLogsFrontend extends BaseModel
{
    public const PHONE    = 1;
    public const DESKSTOP = 2;
    public const ROBOT    = 3;
    public const MOBILE   = 4;
    public const TABLET   = 5;
    public const OTHER    = 6;

    /**
     * @var array $guarded
     */
    protected $guarded = ['id'];
}
