<?php

namespace App\Http\SingleActions\Backend\Merchant\Notice\Marquee;

use Illuminate\Http\JsonResponse;

/**
 * Class AddDoAction
 * @package App\Http\SingleActions\Backend\Merchant\Notice\Marquee
 */
class AddDoAction extends BaseAction
{
    /**
     * ***
     * @param array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $inputDatas['platform_id'] = $this->currentPlatformEloq->id;
        $inputDatas['author_id']   = $this->user->id;
        $this->model->fill($inputDatas);
        $result = $this->model->save();
        if ($result) {
            $msgOut = msgOut();
            return $msgOut;
        }
        throw new \Exception('201600');
    }
}
