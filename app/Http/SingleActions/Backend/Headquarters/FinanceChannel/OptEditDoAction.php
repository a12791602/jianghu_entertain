<?php

namespace App\Http\SingleActions\Backend\Headquarters\FinanceChannel;

use Illuminate\Http\JsonResponse;

/**
 * Class OptEditDoAction
 *
 * @package App\Http\SingleActions\Backend\Headquarters\FinanceChannel
 */
class OptEditDoAction extends BaseAction
{
    /**
     * @param  array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $model                        = $this->model->find($inputDatas['id']);
        $inputDatas['last_editor_id'] = $this->currentAdmin->id;
        $model->fill($inputDatas);
        if ($model->save()) {
            throw new \Exception('300801');
        }
        $msgOut = msgOut();
        return $msgOut;
    }
}
