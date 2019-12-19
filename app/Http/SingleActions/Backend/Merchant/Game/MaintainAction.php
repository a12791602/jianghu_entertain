<?php

namespace App\Http\SingleActions\Backend\Merchant\Game;

use Illuminate\Http\JsonResponse;

/**
 * Class MaintainAction
 * @package App\Http\SingleActions\Backend\Merchant\Game
 */
class MaintainAction extends BaseAction
{
    /**
     * @param array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        if ($this->model->where('id', $inputDatas['id'])->update(['is_maintain' => $inputDatas['is_maintain']])) {
            $results = msgOut(true);
            return $results;
        }
        throw new \Exception('200201');
    }
}
