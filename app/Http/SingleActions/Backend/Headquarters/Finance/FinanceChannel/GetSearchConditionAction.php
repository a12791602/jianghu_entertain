<?php

namespace App\Http\SingleActions\Backend\Headquarters\Finance\FinanceChannel;

use App\Models\Finance\SystemFinanceType;
use App\Models\Finance\SystemFinanceVendor;
use Illuminate\Http\JsonResponse;

/**
 * Class GetSearchConditionAction
 *
 * @package App\Http\SingleActions\Backend\Headquarters\Finance\FinanceChannel
 */
class GetSearchConditionAction extends BaseAction
{
    /**
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(): JsonResponse
    {
        $channels = $this->model->get(['id', 'type_id', 'vendor_id', 'name']);
        $types    = SystemFinanceType::get(['id', 'name']);
        $vendors  = SystemFinanceVendor::get(['id', 'name']);
        $datas    = [
                     'channels' => $channels,
                     'vendors'  => $vendors,
                     'types'    => $types,
                    ];
        return msgOut($datas);
    }
}
