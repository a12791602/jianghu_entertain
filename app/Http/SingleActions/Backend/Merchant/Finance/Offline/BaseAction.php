<?php

namespace App\Http\SingleActions\Backend\Merchant\Finance\Offline;

use App\Models\Finance\SystemFinanceOfflineInfo;

/**
 * Class BaseAction
 * @package App\Http\SingleActions\Backend\Merchant\Finance\Offline
 */
class BaseAction
{

    /**
     * @var SystemFinanceOfflineInfo
     */
    protected $model;

    /**
     * BaseAction constructor.
     * @param SystemFinanceOfflineInfo $systemFinanceOfflineInfo SystemFinanceOfflineInfo.
     */
    public function __construct(SystemFinanceOfflineInfo $systemFinanceOfflineInfo)
    {
        $this->model = $systemFinanceOfflineInfo;
    }
}
