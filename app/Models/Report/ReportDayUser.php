<?php

namespace App\Models\Report;

use App\Models\BaseAuthModel;
use App\Models\Report\Logics\ReportDayUserLogics;

/**
 * 用户日报表
 */
class ReportDayUser extends BaseAuthModel
{
    /**
     * ReportDayUserLogics
     */
    use ReportDayUserLogics;
    
    /**
     * @var array $guarded
     */
    protected $guarded = ['id'];

    /**
     * @var array
     */
    public static $fieldDefinition = [
                                      'mobile' => '会员账号(手机)',
                                      'guid'   => '会员UID',
                                     ];
}
