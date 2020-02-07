<?php

namespace App\Http\SingleActions\Backend\Headquarters\GameVendor;

use App\Http\SingleActions\MainAction;
use App\Models\Game\GamesVendor;
use Illuminate\Http\Request;

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
     * @param Request     $request     Request.
     * @param GamesVendor $gamesVendor GamesVendor.
     */
    public function __construct(
        Request $request,
        GamesVendor $gamesVendor
    ) {
        parent::__construct($request);
        $this->model = $gamesVendor;
    }
}
