<?php

namespace App\Http\SingleActions\Backend\Merchant\Game;

use Illuminate\Http\JsonResponse;

/**
 * Class DoHotAction
 * @package App\Http\SingleActions\Backend\Merchant\Game
 */
class DoHotAction extends BaseAction
{
    /**
     * @param array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        if ($this->model->where('id', $inputDatas['id'])->update(['hot_new' => $inputDatas['hot_new']])) {
            return msgOut();
        }
        throw new \Exception('200200');
    }
}
