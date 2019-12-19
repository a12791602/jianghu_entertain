<?php

namespace App\Http\SingleActions\Backend\Merchant\Game;

use Illuminate\Http\JsonResponse;

/**
 * Class RecommendAction
 * @package App\Http\SingleActions\Backend\Merchant\Game
 */
class RecommendAction extends BaseAction
{
    /**
     * @param array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        if ($this->model->where('id', $inputDatas['id'])->update(['is_recommend' => $inputDatas['is_recommend']])) {
            $results = msgOut(true);
            return $results;
        }
        throw new \Exception('200202');
    }
}
