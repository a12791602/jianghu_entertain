<?php

namespace App\Models\Game;

use App\Models\BaseModel;
use App\Models\Game\Logics\GameVendorReportDayLogics;

/**
 * Class GameVendorReportDay
 *
 * @package App\Models\Game
 */
class GameVendorReportDay extends BaseModel
{
    /**
     * GameVendorReportDayLogics
     */
    use GameVendorReportDayLogics;

    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @var array
     */
    public static $fieldDefinition = ['game_vendor_name' => '游戏厂商'];
}
