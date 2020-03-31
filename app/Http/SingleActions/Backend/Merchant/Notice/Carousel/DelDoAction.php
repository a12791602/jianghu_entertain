<?php

namespace App\Http\SingleActions\Backend\Merchant\Notice\Carousel;

use Illuminate\Http\JsonResponse;

/**
 * Class DelDoAction
 * @package App\Http\SingleActions\Backend\Merchant\Notice\Carousel
 */
class DelDoAction extends BaseAction
{
    /**
     * @param array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $result = $this->model->where('id', $inputDatas['id'])->delete();
        if ($result) {
            return msgOut();
        }
        throw new \Exception('201903');
    }
}
