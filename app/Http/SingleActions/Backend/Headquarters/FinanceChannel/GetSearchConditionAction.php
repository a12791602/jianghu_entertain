<?php

namespace App\Http\SingleActions\Backend\Headquarters\FinanceChannel;

use App\Models\Finance\SystemFinanceType;
use App\Models\Finance\SystemFinanceVendor;
use Illuminate\Http\JsonResponse;

/**
 * Class GetSearchConditionAction
 *
 * @package App\Http\SingleActions\Backend\Headquarters\FinanceChannel
 */
class GetSearchConditionAction extends BaseAction
{
    /**
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(): JsonResponse
    {
        $channels = $this->model->select(['id', 'type_id', 'vendor_id', 'name'])->get();
        $types    = SystemFinanceType::select(['id', 'name'])->get();
        $vendors  = SystemFinanceVendor::select(['id', 'name'])->get();
        $datas    = [
                     'channels' => $channels,
                     'vendors'  => $vendors,
                     'types'    => $types,
                    ];
        $msgOut   = msgOut(true, $datas);
        return $msgOut;
    }
}
