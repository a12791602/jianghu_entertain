<?php

namespace App\Http\SingleActions\Backend\Merchant\Game;

use App\Models\Platform\GamesPlatform;

/**
 * Class BaseAction
 * @package App\Http\SingleActions\Backend\Merchant\Game
 */
class BaseAction
{

    /**
     * @var GamesPlatform
     */
    protected $model;

    /**
     * BaseAction constructor.
     * @param GamesPlatform $gamesPlatform GamesPlatforms.
     */
    public function __construct(GamesPlatform $gamesPlatform)
    {
        $this->model = $gamesPlatform;
    }
}
