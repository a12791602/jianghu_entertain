<?php

namespace App\Http\SingleActions\Backend\Headquarters\GameVendor;

use App\Http\SingleActions\MainAction;
use App\Models\Game\GameVendor;
use Illuminate\Http\Request;

/**
 * Class BaseAction
 *
 * @package App\Http\SingleActions\Backend\Headquarters\GameVendor
 */
class BaseAction extends MainAction
{

    /**
     * @var GameVendor Model.
     */
    protected $model;

    /**
     * BaseAction constructor.
     *
     * @param Request     $request     Request.
     * @param GameVendor $gamesVendor GameVendor.
     */
    public function __construct(
        Request $request,
        GameVendor $gamesVendor
    ) {
        parent::__construct($request);
        $this->model = $gamesVendor;
    }
}
