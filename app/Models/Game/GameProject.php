<?php

namespace App\Models\Game;

use App\Models\BaseModel;
use App\Models\User\Logics\GameProjectLogics;

/**
 * Class Game
 * @package App\Models\Game
 */
class GameProject extends BaseModel
{
    use GameProjectLogics;


    public const STATUS_BET           = 0;//0已投注
    public const STATUS_CANCEL        = 1;//1已撤销
    public const STATUS_LOSE          = 2;//2未中奖
    public const STATUS_WIN           = 3;//3已中奖
    public const STATUS_WIN_CALCULATE = 4;//4已派奖

    /**
     * @var array
     */
    protected $guarded = ['id'];
}
