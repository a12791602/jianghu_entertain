<?php

namespace App\Http\SingleActions\Backend\Merchant\Finance\Offline;

use App\Http\SingleActions\MainAction;
use App\Models\Finance\SystemFinanceOfflineInfo;
use Illuminate\Http\Request;

/**
 * Class MainAction
 * @package App\Http\SingleActions\Backend\Merchant\Finance\Offline
 */
class BaseAction extends MainAction
{

    /**
     * @var SystemFinanceOfflineInfo
     */
    protected $model;

     /**
      * MainAction constructor.
      * @param SystemFinanceOfflineInfo $systemFinanceOfflineInfo SystemFinanceOfflineInfo.
      * @param Request                  $request                  Request.
      * @throws \Exception Exception.
      */
    public function __construct(
        SystemFinanceOfflineInfo $systemFinanceOfflineInfo,
        Request $request
    ) {
        parent::__construct($request);
        $this->model = $systemFinanceOfflineInfo;
    }
}
