<?php

namespace App\Models\Report;

use App\Models\BaseAuthModel;
use App\Models\Report\Logics\ReportDayGameVendorLogics;

/**
 * 游戏厂商日总报表
 */
class ReportDayGameVendor extends BaseAuthModel
{
    /**
     * ReportDayGameVendorLogics
     */
    use ReportDayGameVendorLogics;
    
    /**
     * @var array $guarded
     */
    protected $guarded = ['id'];
}
