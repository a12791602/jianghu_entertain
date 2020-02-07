<?php

namespace App\Http\SingleActions\Backend\Headquarters\Game;

use App\Http\SingleActions\MainAction;
use App\Models\Game\Game;

/**
 * Class BaseAction
 *
 * @package App\Http\SingleActions\Backend\Headquarters\Game
 */
class BaseAction extends MainAction
{

    /**
     * @var Game Model.
     */
    protected $model;

    /**
     * BaseAction constructor.
     *
     * @param Game $game Game.
     */
    public function __construct(Game $game)
    {
        $this->model = $game;
    }
}
