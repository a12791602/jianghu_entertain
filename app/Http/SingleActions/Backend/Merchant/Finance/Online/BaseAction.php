<?php

namespace App\Http\SingleActions\Backend\Merchant\Finance\Online;

use App\Http\SingleActions\MainAction;
use App\Models\Finance\SystemFinanceOnlineInfo;
use Illuminate\Http\Request;

/**
 * Class MainAction
 * @package App\Http\SingleActions\Backend\Merchant\Finance\Online
 */
class BaseAction extends MainAction
{

    /**
     * @var SystemFinanceOnlineInfo $model
     */
    protected $model;

     /**
      * MainAction constructor.
      * @param SystemFinanceOnlineInfo $systemFinanceOnlineInfo SystemFinanceOnline.
      * @param Request                 $request                 Request.
      * @throws \Exception Exception.
      */
    public function __construct(SystemFinanceOnlineInfo $systemFinanceOnlineInfo, Request $request)
    {
        parent::__construct($request);
        $this->model = $systemFinanceOnlineInfo;
    }
}
