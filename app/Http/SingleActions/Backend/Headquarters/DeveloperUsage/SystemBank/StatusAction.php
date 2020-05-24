<?php

namespace App\Http\SingleActions\Backend\Headquarters\DeveloperUsage\SystemBank;

use Illuminate\Http\JsonResponse;

/**
 * Class StatusAction
 *
 * @package App\Http\SingleActions\Backend\Headquarters\DeveloperUsage\SystemBank
 */
class StatusAction extends BaseAction
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
            throw new \Exception('300904');
        }
        return msgOut();
    }
}
