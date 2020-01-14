<?php

namespace App\Http\SingleActions\Backend\Merchant\Notice\Marquee;

use App\Http\Controllers\BackendApi\BackEndApiMainController;
use Illuminate\Http\JsonResponse;

/**
 * Class StatusAction
 * @package App\Http\SingleActions\Backend\Merchant\Notice\Marquee
 */
class StatusAction extends BaseAction
{
    /**
     * @param BackEndApiMainController $contll     Contll.
     * @param array                    $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(BackEndApiMainController $contll, array $inputDatas): JsonResponse
    {
        $result = $this->model->where('id', $inputDatas['id'])->update(
            [
             'last_editor_id' => $contll->currentAdmin->id,
             'status'         => $inputDatas['status'],
            ],
        );
        if ($result) {
            $msgOut = msgOut(true);
            return $msgOut;
        }
        throw new \Exception('201603');
    }
}
