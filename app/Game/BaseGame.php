<?php

namespace App\Game;

use App\Models\Game\GameVendor;

/**
 * Class Base
 * @package App\Game\Core
 */
abstract class BaseGame implements GameIF
{

    /**
     * @var GameVendor
     */
    protected $gameVendor;

    /**
     * @var \App\Models\Game\Game
     */
    protected $gameItem;

    /**
     * @var \App\Http\SingleActions\MainAction
     */
    protected $sysObj;

    /**
     * 赋值.
     * @param GameVendor $vendor GameVendor.
     * @return void
     */
    public function setVendor(GameVendor $vendor): void
    {
        $this->gameVendor = $vendor;
    }
}
