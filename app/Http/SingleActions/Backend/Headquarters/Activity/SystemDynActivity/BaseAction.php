<?php

namespace App\Http\SingleActions\Backend\Headquarters\Activity\SystemDynActivity;

use App\Http\SingleActions\MainAction;
use App\Models\Activity\ActivitiesDynSystem;
use Illuminate\Http\Request;

/**
 * Class BaseAction
 *
 * @package App\Http\SingleActions\Backend\Headquarters\Activity\SystemDynActivity
 */
class BaseAction extends MainAction
{

    /**
     * @var ActivitiesDynSystem $model
     */
    protected $model;

    /**
     * BaseAction constructor.
     *
     * @param Request             $request           Request.
     * @param ActivitiesDynSystem $systemDynActivity SystemDynAction.
     */
    public function __construct(
        Request $request,
        ActivitiesDynSystem $systemDynActivity
    ) {
        parent::__construct($request);
        $this->model = $systemDynActivity;
    }
}
