<?php

namespace App\Http\SingleActions\Backend\Merchant\Bank;

use Illuminate\Http\JsonResponse;

/**
 * Class StatusAction
 * @package App\Http\SingleActions\Backend\Merchant\Notice\Carousel
 */
class StatusAction extends BaseAction
{
    /**
     * @param array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $result = $this->model->where('id', $inputDatas['id'])->update(['status' => $inputDatas['status']]);
        if ($result) {
            return msgOut(true);
        }
        throw new \Exception('202100');
    }
}
