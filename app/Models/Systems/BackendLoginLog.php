<?php

namespace App\Models\Systems;

use App\Models\BaseModel;
use App\Models\Systems\Traits\BackendLoginLogLogics;

/**
 * 管理员登录记录
 */
class BackendLoginLog extends BaseModel
{
    use BackendLoginLogLogics;
    
    public const TYPE_HEADQUARTERS = 1;
    public const TYPE_MERCHANT     = 2;

    /**
     * @var array $guarded
     */
    protected $guarded = ['id'];
}
