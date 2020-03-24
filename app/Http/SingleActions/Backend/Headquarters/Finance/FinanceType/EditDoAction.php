<?php

namespace App\Http\SingleActions\Backend\Headquarters\Finance\FinanceType;

use Illuminate\Http\JsonResponse;

/**
 * Class EditDoAction
 *
 * @package App\Http\SingleActions\Backend\Headquarters\Finance\FinanceType
 */
class EditDoAction extends BaseAction
{
    
    /**
     * @param  array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $model = $this->model->find($inputDatas['id']);
        if ($model === null) {
            throw new \Exception('300505');
        }
        $inputDatas['last_editor_id'] = $this->user->id;
        $model->fill($inputDatas);
        if (!$model->save()) {
            throw new \Exception('300501');
        }
        $msgOut = msgOut();
        return $msgOut;
    }
}
