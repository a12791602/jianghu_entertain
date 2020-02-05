<?php

namespace App\Http\SingleActions\Backend\Merchant\Activity\Dynamic;

use App\Http\SingleActions\MainAction;
use App\Models\Platform\SystemDynActivityPlatform;
use Illuminate\Http\Request;

/**
 * Class MainAction
 * @package App\Http\SingleActions\Backend\Merchant\Activity\Dyn
 */
class BaseAction extends MainAction
{

    /**
     * @var SystemDynActivityPlatform $model
     */
    protected $model;

     /**
      * MainAction constructor.
      * @param SystemDynActivityPlatform $systemDynActivityPlatform SystemDynActivityPlatform.
      * @param Request                   $request                   Request.
      * @throws \Exception Exception.
      */
    public function __construct(
        SystemDynActivityPlatform $systemDynActivityPlatform,
        Request $request
    ) {
        parent::__construct($request);
        $this->model = $systemDynActivityPlatform;
    }
}
