<?php

namespace App\Http\SingleActions\Backend\Headquarters\SystemDynActivity;

use App\Http\SingleActions\MainAction;
use App\Models\Activity\SystemDynActivity;
use Illuminate\Http\Request;

/**
 * Class BaseAction
 *
 * @package App\Http\SingleActions\Backend\Headquarters\SystemDynActivity
 */
class BaseAction extends MainAction
{

    /**
     * @var SystemDynActivity $model
     */
    protected $model;

    /**
     * BaseAction constructor.
     *
     * @param Request           $request           Request.
     * @param SystemDynActivity $systemDynActivity SystemDynAction.
     */
    public function __construct(
        Request $request,
        SystemDynActivity $systemDynActivity
    ) {
        parent::__construct($request);
        $this->model = $systemDynActivity;
    }
}
