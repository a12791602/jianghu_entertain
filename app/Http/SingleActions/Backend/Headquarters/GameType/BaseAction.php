<?php

namespace App\Http\SingleActions\Backend\Headquarters\GameType;

use App\Http\SingleActions\MainAction;
use App\Models\Game\GamesType;

/**
 * Class BaseAction
 *
 * @package App\Http\SingleActions\Backend\Headquarters\GameType
 */
class BaseAction extends MainAction
{

    /**
     * @var GamesType Model.
     */
    protected $model;

    /**
     * BaseAction constructor.
     *
     * @param GamesType $gamesType GamesType.
     */
    public function __construct(GamesType $gamesType)
    {
        $this->model = $gamesType;
    }
}
