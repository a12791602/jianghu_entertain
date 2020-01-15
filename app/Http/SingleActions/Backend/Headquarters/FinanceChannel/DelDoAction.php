<?php

namespace App\Http\SingleActions\Backend\Headquarters\FinanceChannel;

use Illuminate\Http\JsonResponse;

/**
 * Class DelDoAction
 *
 * @package App\Http\SingleActions\Backend\Headquarters\FinanceChannel
 */
class DelDoAction extends BaseAction
{
    /**
     * @param  array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        if ($this->model->where('id', $inputDatas['id'])->delete()) {
            $msgOut = msgOut(true);
            return $msgOut;
        }
        throw new \Exception('300803');
    }
}
