<?php

namespace App\Game\Core;

use App\Models\Game\GameVendor;

/**
 * Class Base
 * @package App\Game\Core
 */
abstract class Base implements Game
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
     * Base constructor.
     * @param GameVendor $vendor GameVendor.
     */
    public function __construct(GameVendor $vendor)
    {
        $this->gameVendor = $vendor;
    }
}
