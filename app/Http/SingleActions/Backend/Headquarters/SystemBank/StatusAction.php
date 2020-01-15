<?php

namespace App\Http\SingleActions\Backend\Headquarters\SystemBank;

use App\Http\Controllers\BackendApi\BackEndApiMainController;
use Illuminate\Http\JsonResponse;

/**
 * Class StatusAction
 *
 * @package App\Http\SingleActions\Backend\Headquarters\SystemBank
 */
class StatusAction extends BaseAction
{
    /**
     * @param  BackEndApiMainController $contll     Contll.
     * @param  array                    $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(BackEndApiMainController $contll, array $inputDatas): JsonResponse
    {
        $update = $this->model->where('id', $inputDatas['id'])->update(
            [
             'status'         => $inputDatas['status'],
             'last_editor_id' => $contll->currentAdmin->id,
            ],
        );
        if (!$update) {
            throw new \Exception('300904');
        }
        $msgOut = msgOut(true);
        return $msgOut;
    }
}
