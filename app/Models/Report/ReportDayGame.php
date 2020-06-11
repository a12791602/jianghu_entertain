<?php

namespace App\Models\Report;

use App\Models\BaseModel;

/**
 * Class ReportDayGame
 *
 * @package App\Models\Report
 */
class ReportDayGame extends BaseModel
{

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
