<?php

namespace App\Http\SingleActions\Backend\Merchant\Notice\Marquee;

use App\Http\Controllers\BackendApi\BackEndApiMainController;
use Illuminate\Http\JsonResponse;

/**
 * Class AddDoAction
 * @package App\Http\SingleActions\Backend\Merchant\Notice\Marquee
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
        $inputDatas['platform_id'] = $contll->currentPlatformEloq->id;
        $inputDatas['author_id']   = $contll->currentAdmin->id;
        $this->model->fill($inputDatas);
        $result = $this->model->save();
        if ($result) {
            $msgOut = msgOut(true);
            return $msgOut;
        }
        throw new \Exception('201600');
    }
}
