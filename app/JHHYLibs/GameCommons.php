<?php

namespace App\JHHYLibs;

use App\Models\Game\GameVendor;
use Illuminate\Support\Facades\Config;

/**
 * Class GameCommons
 * @package App\JHHYLibs
 */
class GameCommons
{
    /**
     * @param GameVendor $vendor GameVendor.
     * @return \Illuminate\Contracts\Foundation\Application|mixed
     * @throws \Exception Exception.
     */
    public static function gameInit(GameVendor $vendor)
    {
        $className = Config::get('games_classes.' . $vendor->sign);
        if ($className === null) {
            throw new \Exception('100708');//'游戏服务出错!'
        }
        $gameClass = resolve($className);
        $gameClass->setVendor($vendor);
        return $gameClass;
    }
}
