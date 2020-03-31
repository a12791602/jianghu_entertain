<?php

namespace App\Http\SingleActions\Backend\Merchant\Activity\Dynamic;

use Illuminate\Http\JsonResponse;

/**
 * Class StatusAction
 * @package App\Http\SingleActions\Backend\Merchant\Activity\Dyn
 */
class StatusAction extends BaseAction
{
    /**
     *
     * @param array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $result = $this->model->where('id', $inputDatas['id'])->update(
            [
             'status'         => $inputDatas['status'],
             'last_editor_id' => $this->user->id,
            ],
        );
        if ($result) {
            return msgOut();
        }
        throw new \Exception('202200');
    }
}
