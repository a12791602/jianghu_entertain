<?php

namespace App\Models\Report;

use App\Models\BaseAuthModel;
use App\Models\Report\Logics\ReportDayUserGameCommissionLogics;

/**
 * 用户单个游戏洗码日报表
 */
class ReportDayUserGameCommission extends BaseAuthModel
{
    /**
     * ReportDayUserGameCommissionLogics
     */
    use ReportDayUserGameCommissionLogics;

    /**
     * @var array $guarded
     */
    protected $guarded = ['id'];
}
