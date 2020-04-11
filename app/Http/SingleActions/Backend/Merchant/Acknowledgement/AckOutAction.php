<?php

namespace App\Http\SingleActions\Backend\Merchant\Acknowledgement;

use Illuminate\Http\JsonResponse;

/**
 * Class AckInAction
 * @package App\Http\SingleActions\Backend\Merchant\Acknowledgement
 */
class AckOutAction
{
    /**
     * @param array $inputDatas 参数.
     * @return JsonResponse return.
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas = []): JsonResponse
    {
        unset($inputDatas);
        return msgOut();
    }
}
