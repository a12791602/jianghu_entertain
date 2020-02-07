<?php

namespace App\Http\SingleActions\Backend\Headquarters\SystemDynActivity;

use App\Http\SingleActions\MainAction;
use App\Models\Activity\SystemDynActivity;

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
     * @param SystemDynActivity $systemDynActivity SystemDynAction.
     */
    public function __construct(SystemDynActivity $systemDynActivity)
    {
        $this->model = $systemDynActivity;
    }
}
