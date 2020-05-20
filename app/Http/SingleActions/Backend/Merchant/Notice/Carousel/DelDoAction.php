<?php

namespace App\Http\SingleActions\Backend\Merchant\Notice\Carousel;

use App\Models\Systems\StaticResource;
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
        $modelResult = $this->model->find($inputDatas['id']);
        if ($modelResult instanceof $this->model) {
            $hasValue = $modelResult->pic_id !== null;
            if ($hasValue) {
                StaticResource::resourceClean($modelResult->pic_id);
            }
            return msgOut();
        }
        throw new \Exception('201903');
    }
}
