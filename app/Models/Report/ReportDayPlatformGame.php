<?php

namespace App\Models\Report;

use App\Models\BaseModel;
use App\Models\Report\Logics\ReportDayPlatformGameLogics;

/**
 * Class ReportDayPlatformGame
 *
 * @package App\Models\Report
 */
class ReportDayPlatformGame extends BaseModel
{
    /**
     * ReportDayPlatformGameLogics
     */
    use ReportDayPlatformGameLogics;

    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @var array
     */
    public static $fieldDefinition = [
                                      'game_vendor_sign' => '游戏厂商标识',
                                      'game_name'        => '游戏名称',
                                     ];
}
