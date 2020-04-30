<?php

namespace App\Http\SingleActions\Backend\Headquarters\DeveloperUsage\Schedule;

use App\Models\Systems\StaticResource;
use Illuminate\Http\JsonResponse;

/**
 * Class EditAction
 *
 * @package App\Http\SingleActions\Backend\Headquarters\DeveloperUsage\Schedule
 */
class EditAction extends BaseAction
{
    
    /**
     * @param  array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $model = $this->model->find($inputDatas['id']);
        if (!$model instanceof $this->model) {
            throw new \Exception('302601');
        }
        $model->fill($inputDatas);
        if (!$model->save()) {
            throw new \Exception('302602');
        }
        StaticResource::saveSchedule();
        return msgOut();
    }
}
