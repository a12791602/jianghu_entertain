<?php

namespace App\Http\SingleActions\Backend\Headquarters\Finance\FinanceChannel;

use Illuminate\Http\JsonResponse;

/**
 * Class StatusDoAction
 *
 * @package App\Http\SingleActions\Backend\Headquarters\Finance\FinanceChannel
 */
class StatusDoAction extends BaseAction
{

    /**
     * @param  array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $update = $this->model->where('id', $inputDatas['id'])->update(
            [
             'status'         => $inputDatas['status'],
             'last_editor_id' => $this->user->id,
            ],
        );
        if (!$update) {
            throw new \Exception('300804');
        }
        return msgOut();
    }
}
