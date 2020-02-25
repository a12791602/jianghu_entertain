<?php

namespace App\Http\SingleActions\Backend\Headquarters\GameType;

use App\Http\SingleActions\MainAction;
use App\Models\Game\GameType;
use Illuminate\Http\Request;

/**
 * Class BaseAction
 *
 * @package App\Http\SingleActions\Backend\Headquarters\GameType
 */
class BaseAction extends MainAction
{

    /**
     * @var GameType Model.
     */
    protected $model;

    /**
     * BaseAction constructor.
     *
     * @param Request  $request   Request.
     * @param GameType $gamesType GameType.
     * @throws \Exception Exception.
     */
    public function __construct(
        Request $request,
        GameType $gamesType
    ) {
        parent::__construct($request);
        $this->model = $gamesType;
    }
}
