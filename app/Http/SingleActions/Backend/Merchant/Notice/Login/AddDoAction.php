<?php

namespace App\Http\SingleActions\Backend\Merchant\Notice\Login;

use Illuminate\Http\JsonResponse;

/**
 * Class AddDoAction
 * @package App\Http\SingleActions\Backend\Merchant\Notice\Login
 */
class AddDoAction extends BaseAction
{
    /**
     * @param array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $inputDatas['author_id']   = $this->user->id;
        $inputDatas['platform_id'] = $this->currentPlatformEloq->id;
        $this->model->fill($inputDatas);
        $result = $this->model->save();
        if ($result) {
            $msgOut = msgOut();
            return $msgOut;
        }
        throw new \Exception('201800');
    }
}
