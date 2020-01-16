<?php

namespace App\Http\SingleActions\Backend\Headquarters\FinanceVendor;

use Illuminate\Http\JsonResponse;

/**
 * Class DelDoAction
 *
 * @package App\Http\SingleActions\Backend\Headquarters\FinanceVendor
 */
class DelDoAction extends BaseAction
{
    /**
     * @param  array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas):JsonResponse
    {
        if ($this->model->where('id', $inputDatas['id'])->delete()) {
            return msgOut();
        } else {
            throw new \Exception('300602');
        }
    }
}
