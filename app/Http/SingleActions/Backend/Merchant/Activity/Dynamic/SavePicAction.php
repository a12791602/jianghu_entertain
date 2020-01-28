<?php

namespace App\Http\SingleActions\Backend\Merchant\Activity\Dynamic;

use App\Http\Controllers\BackendApi\BackEndApiMainController;
use Illuminate\Http\JsonResponse;

/**
 * Class SavePicAction
 * @package App\Http\SingleActions\Backend\Merchant\Activity\Dynamic
 */
class SavePicAction extends BaseAction
{
    /**
     * @param BackEndApiMainController $contll     Contll.
     * @param array                    $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(BackEndApiMainController $contll, array $inputDatas): JsonResponse
    {
        $inputDatas['last_editor_id'] = $contll->currentAdmin->id;
        $result                       = $this->model->where('id', $inputDatas['id'])->update($inputDatas);
        if ($result) {
            $msgOut = msgOut();
            return $msgOut;
        }
        throw new \Exception('202201');
    }
}
