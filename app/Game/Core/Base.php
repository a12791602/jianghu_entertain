<?php

namespace App\Game\Core;

use App\Models\Game\GameVendor;
use App\Models\User\FrontendUser;

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
     * @var FrontendUser
     */
    protected $gameUser;

    /**
     * Base constructor.
     * @param GameVendor   $vendor GameVendor.
     * @param FrontendUser $user   FrontendUser.
     */
    public function __construct(GameVendor $vendor, FrontendUser $user)
    {
        $this->gameVendor = $vendor;
        $this->gameUser   = $user;
    }
}
