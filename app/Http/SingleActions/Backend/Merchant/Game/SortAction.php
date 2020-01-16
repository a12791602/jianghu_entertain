<?php

namespace App\Http\SingleActions\Backend\Merchant\Game;

use Illuminate\Http\JsonResponse;

/**
 * Class SortAction
 * @package App\Http\SingleActions\Backend\Merchant\Game
 */
class SortAction extends BaseAction
{
    /**
     * @param array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        try {
            foreach ($inputDatas['sorts'] as $inputData) {
                $this->model::where('id', $inputData['id'])->update(['sort' => $inputData['sort']]);
            }
            $result = msgOut();
            return $result;
        } catch (\Throwable $exception) {
            throw new \Exception('200203');
        }
    }
}
