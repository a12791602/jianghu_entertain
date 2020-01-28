<?php

namespace App\Http\SingleActions\Backend\Merchant\Activity\Dynamic;

use App\Models\Platform\SystemDynActivityPlatform;

/**
 * Class BaseAction
 * @package App\Http\SingleActions\Backend\Merchant\Activity\Dyn
 */
class BaseAction
{

    /**
     * @var SystemDynActivityPlatform $model
     */
    protected $model;

    /**
     * BaseAction constructor.
     * @param SystemDynActivityPlatform $systemDynActivityPlatform SystemDynActivityPlatform.
     */
    public function __construct(SystemDynActivityPlatform $systemDynActivityPlatform)
    {
        $this->model = $systemDynActivityPlatform;
    }
}
