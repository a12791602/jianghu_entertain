<?php

namespace App\Http\SingleActions\Backend\Headquarters\SystemBank;

use App\Http\Controllers\BackendApi\BackEndApiMainController;
use Illuminate\Http\JsonResponse;

/**
 * Class EditAction
 *
 * @package App\Http\SingleActions\Backend\Headquarters\SystemBank
 */
class EditAction extends BaseAction
{
    /**
     * @param  BackEndApiMainController $contll     Contll.
     * @param  array                    $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(BackEndApiMainController $contll, array $inputDatas): JsonResponse
    {
        $model                        = $this->model->find($inputDatas['id']);
        $inputDatas['last_editor_id'] = $contll->currentAdmin->id;
        $model->fill($inputDatas);
        if (!$model->save()) {
            throw new \Exception('300901');
        }
        $msgOut = msgOut();
        return $msgOut;
    }
}
