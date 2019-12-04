<?php

namespace App\Http\SingleActions\Backend\Headquarters\GameType;

use App\Http\Controllers\BackendApi\Headquarters\BackEndApiMainController;
use Illuminate\Http\JsonResponse;

/**
 * Class EditDoAction
 * @package App\Http\SingleActions\Backend\Headquarters\GameType
 */
class EditDoAction extends BaseAction
{
    /**
     * @param BackEndApiMainController $contll     Contll.
     * @param array                    $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(BackEndApiMainController $contll, array $inputDatas) :JsonResponse
    {
        $model = $this->model->find($inputDatas['id']);
        $inputDatas['last_editor_id'] = $contll->currentAdmin->id;
        $model->fill($inputDatas);
        if ($model->save()) {
            return msgOut(true);
        } else {
            throw new \Exception('300403');
        }
    }
}