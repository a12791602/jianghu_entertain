<?php

namespace App\Http\SingleActions\Backend\Merchant\Finance\Online;

use App\Models\Finance\SystemFinanceOnlineInfo;

/**
 * Class BaseAction
 * @package App\Http\SingleActions\Backend\Merchant\Finance\Online
 */
class BaseAction
{

    /**
     * @var SystemFinanceOnlineInfo $model
     */
    protected $model;

    /**
     * BaseAction constructor.
     * @param SystemFinanceOnlineInfo $systemFinanceOnlineInfo SystemFinanceOnline.
     */
    public function __construct(SystemFinanceOnlineInfo $systemFinanceOnlineInfo)
    {
        $this->model = $systemFinanceOnlineInfo;
    }
}
