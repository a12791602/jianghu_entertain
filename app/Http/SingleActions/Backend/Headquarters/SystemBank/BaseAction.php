<?php

namespace App\Http\SingleActions\Backend\Headquarters\SystemBank;

use App\Http\SingleActions\MainAction;
use App\Models\Finance\SystemBank;
use Illuminate\Http\Request;

/**
 * Class BaseAction
 *
 * @package App\Http\SingleActions\Backend\Headquarters\SystemBank
 */
class BaseAction extends MainAction
{

    /**
     * @var SystemBank $model
     */
    protected $model;

    /**
     * BaseAction constructor.
     *
     * @param Request    $request    Request.
     * @param SystemBank $systemBank SystemBank.
     */
    public function __construct(
        Request $request,
        SystemBank $systemBank
    ) {
        parent::__construct($request);
        $this->model = $systemBank;
    }
}
