<?php

namespace App\Models\Report;

use App\Models\BaseAuthModel;
use App\Models\Report\Logics\ReportDayUserCommissionLogics;

/**
 * 用户佣金报表
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
