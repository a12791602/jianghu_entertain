<?php

namespace App\Http\SingleActions\Backend\Headquarters\Game;

use App\Http\SingleActions\MainAction;
use App\Models\Game\Game;
use Illuminate\Http\Request;

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
     * @param Request $request Request.
     * @param Game    $game    Game.
     */
    public function __construct(
        Request $request,
        Game $game
    ) {
        parent::__construct($request);
        $this->model = $game;
    }
}
