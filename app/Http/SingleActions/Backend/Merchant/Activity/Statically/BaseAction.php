<?php

namespace App\Http\SingleActions\Backend\Merchant\Activity\Statically;

use App\Models\Activity\SystemStaticActivity;

/**
 * Class BaseAction
 * @package App\Http\SingleActions\Backend\Merchant\Notice\Carousel
 */
class BaseAction
{

    /**
     * @var SystemStaticActivity $model
     */
    public $model;

    /**
     * BaseAction constructor.
     * @param SystemStaticActivity $systemStaticActivity SystemStaticActivity.
     */
    public function __construct(SystemStaticActivity $systemStaticActivity)
    {
        $this->model = $systemStaticActivity;
    }
}
