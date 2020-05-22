<?php

namespace App\Models\Game;

use App\Models\BaseModel;

/**
 * Class GameReportDay
 *
 * @package App\Models\Game
 */
class GameReportDay extends BaseModel
{

    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @var array
     */
    public static $fieldDefinition = ['game_vendor_sign' => '游戏厂商标识'];
}
