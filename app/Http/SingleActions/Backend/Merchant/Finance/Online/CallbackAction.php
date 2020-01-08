<?php

namespace App\Http\SingleActions\Backend\Merchant\Finance\Online;

use App\Http\Controllers\BackendApi\BackEndApiMainController;

/**
 * Class CallbackAction
 * @package App\Http\SingleActions\Backend\Merchant\Finance\Online
 */
class CallbackAction
{
    /**
     * @param BackEndApiMainController $contll   Contll.
     * @param string                   $platform Platform.
     * @param string                   $order    Order.
     * @return string
     */
    public function execute(BackEndApiMainController $contll, string $platform, string $order): string
    {
        return $contll->inputs['test'] . $platform . $order;
    }
}
