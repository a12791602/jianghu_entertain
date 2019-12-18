<?php

namespace App\Http\SingleActions\Backend\Merchant\GameType;

use App\Models\Game\GameTypePlatform;

/**
 * Class BaseAction
 * @package App\Http\SingleActions\Backend\Merchant\GameType
 */
class BaseAction
{

    /**
     * @var GameTypePlatform
     */
    protected $model;

    /**
     * BaseAction constructor.
     * @param GameTypePlatform $gameTypePlatform GameTypePlatform.
     */
    public function __construct(GameTypePlatform $gameTypePlatform)
    {
        $this->model = $gameTypePlatform;
    }
}
