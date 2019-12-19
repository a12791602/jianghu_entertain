<?php

namespace App\Http\SingleActions\Backend\Headquarters\FinanceVendor;

use App\Http\Controllers\BackendApi\BackEndApiMainController;
use Illuminate\Http\JsonResponse;

/**
 * Class StatusDoAction
 *
 * @package App\Http\SingleActions\Backend\Headquarters\FinanceVendor
 */
class StatusDoAction extends BaseAction
{
    /**
     * @param  BackEndApiMainController $contll     Contll.
     * @param  array                    $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(BackEndApiMainController $contll, array $inputDatas): JsonResponse
    {
        if ($this->model->where('id', $inputDatas['id'])->update(
            [
                'status'         => $inputDatas['status'],
                'last_editor_id' => $contll->currentAdmin->id,
            ],
        )
        ) {
            return msgOut(true);
        } else {
            throw new \Exception('300604');
        }
    }
}
