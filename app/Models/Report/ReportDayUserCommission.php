<?php

namespace App\Models\Report;

use App\Models\BaseAuthModel;
use App\Models\Report\Logics\ReportDayUserCommissionLogics;

/**
 * 用户单个游戏厂商洗码日报表
 */
class ReportDayUserCommission extends BaseAuthModel
{
    /**
     * ReportDayUserCommissionLogics
     */
    use ReportDayUserCommissionLogics;
    
    /**
     * @var array $guarded
     */
    protected $guarded = ['id'];
}
