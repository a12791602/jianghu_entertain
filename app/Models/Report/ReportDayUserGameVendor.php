<?php

namespace App\Models\Report;

use App\Models\BaseModel;
use App\Models\Report\Logics\ReportDayUserGameVendorLogics;

/**
 * Class ReportDayUserGameVendor
 *
 * @package App\Models\Report
 */
class ReportDayUserGameVendor extends BaseModel
{
    /**
     * ReportDayUserGameVendorLogics
     */
    use ReportDayUserGameVendorLogics;

    /**
     * @var array
     */
    protected $guarded = ['id'];
}
