<?php

namespace App\Http\SingleActions\Backend\Merchant\Notice\Login;

use App\Http\Controllers\BackendApi\BackEndApiMainController;
use Illuminate\Http\JsonResponse;

/**
 * Class AddDoAction
 * @package App\Http\SingleActions\Backend\Merchant\Notice\Login
 */
class AddDoAction extends BaseAction
{
    /**
     * @param BackEndApiMainController $contll     Contll.
     * @param array                    $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(BackEndApiMainController $contll, array $inputDatas): JsonResponse
    {
        $inputDatas['author_id']   = $contll->currentAdmin->id;
        $inputDatas['platform_id'] = $contll->currentPlatformEloq->id;
        $this->model->fill($inputDatas);
        $result = $this->model->save();
        if ($result) {
            $msgOut = msgOut(true);
            return $msgOut;
        }
        throw new \Exception('201800');
    }
}
