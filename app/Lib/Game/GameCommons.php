<?php

namespace App\Lib\Game;

use App\Models\Game\GameVendor;

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
        $sign      = strtoupper($vendor->sign);
        $className = 'App\\Game\\GameModule\\' . $sign . '\\' . $sign . 'Game';
        try {
            $gameClass = resolve($className);
        } catch (\Throwable $e) {
            throw new \Exception('100708');//'游戏服务出错!'
        }
        $gameClass->setVendor($vendor);
        return $gameClass;
    }
}
