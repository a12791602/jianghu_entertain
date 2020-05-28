<?php

namespace App\Http\SingleActions\Backend\Merchant\Activity\Statically;

use Illuminate\Http\JsonResponse;

/**
 * Class AddDoAction
 * @package App\Http\SingleActions\Backend\Merchant\Notice\Carousel
 */
class AddDoAction extends BaseAction
{
    /**
     * @param array $inputData InputData.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputData): JsonResponse
    {
        $inputData['author_id']   = $this->user->id;
        $inputData['platform_id'] = $this->currentPlatformEloq->id;
        $this->model->fill($inputData);
        $result = $this->model->save();
        if ($result) {
            return msgOut();
        }
        throw new \Exception('202000');
    }
}
