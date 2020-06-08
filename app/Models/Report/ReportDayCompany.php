<?php

namespace App\Models\Report;

use App\Models\BaseAuthModel;
use App\Models\Report\Logics\ReportDayCompanyLogics;

/**
 * 公司日报表
 */
class ReportDayCompany extends BaseAuthModel
{
    /**
     * ReportDayCompanyLogics
     */
    use ReportDayCompanyLogics;

    /**
     * @var array $guarded
     */
    protected $guarded = ['id'];
}
