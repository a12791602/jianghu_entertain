<?php

namespace App\Http\SingleActions\Backend\Headquarters\DeveloperUsage\Schedule;

use App\Models\Systems\StaticResource;
use Illuminate\Http\JsonResponse;

/**
 * Class DeleteAction
 *
 * @package App\Http\SingleActions\Backend\Headquarters\DeveloperUsage\Schedule
 */
class DeleteAction extends BaseAction
{
    /**
     * @param array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        if (!$this->model->where('id', $inputDatas['id'])->delete()) {
            throw new \Exception('302603');
        }
        StaticResource::saveSchedule();
        return msgOut();
    }
}
