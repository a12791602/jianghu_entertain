<?php

namespace App\Http\SingleActions\Backend\Merchant\Activity\Statically;

use App\Http\SingleActions\MainAction;
use App\Models\Activity\SystemStaticActivity;
use Illuminate\Http\Request;

/**
 * Class MainAction
 * @package App\Http\SingleActions\Backend\Merchant\Notice\Carousel
 */
class BaseAction extends MainAction
{

    /**
     * @var SystemStaticActivity $model
     */
    public $model;

     /**
      * MainAction constructor.
      * @param SystemStaticActivity $systemStaticActivity SystemStaticActivity.
      * @param Request              $request              Request.
      * @throws \Exception Exception.
      */
    public function __construct(SystemStaticActivity $systemStaticActivity, Request $request)
    {
        parent::__construct($request);
        $this->model = $systemStaticActivity;
    }
}
