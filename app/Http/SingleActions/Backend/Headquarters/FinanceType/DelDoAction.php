<?php

namespace App\Http\SingleActions\Backend\Headquarters\FinanceType;

use Illuminate\Http\JsonResponse;

/**
 * Class DelDoAction
 *
 * @package App\Http\SingleActions\Backend\Headquarters\FinanceType
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
            return msgOut(true);
        } else {
            throw new \Exception('300502');
        }
    }
}
