<?php

namespace App\Http\SingleActions\Backend\Headquarters\GameVendor;

use App\Http\SingleActions\MainAction;
use App\Models\Game\GamesVendor;

/**
 * Class BaseAction
 *
 * @package App\Http\SingleActions\Backend\Headquarters\GameVendor
 */
class BaseAction extends MainAction
{

    /**
     * @var GamesVendor Model.
     */
    protected $model;

    /**
     * BaseAction constructor.
     *
     * @param GamesVendor $gamesVendor GamesVendor.
     */
    public function __construct(GamesVendor $gamesVendor)
    {
        $this->model = $gamesVendor;
    }
}
