<?php

namespace App\Http\SingleActions\Backend\Headquarters\GameType;

use App\Http\SingleActions\MainAction;
use App\Models\Game\GamesType;
use Illuminate\Http\Request;

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
     * @param Request   $request   Request.
     * @param GamesType $gamesType GamesType.
     */
    public function __construct(
        Request $request,
        GamesType $gamesType
    ) {
        parent::__construct($request);
        $this->model = $gamesType;
    }
}
