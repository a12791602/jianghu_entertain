<?php

namespace App\Http\SingleActions\Backend\Headquarters\DeveloperUsage\Schedule;

use App\Models\Systems\StaticResource;
use Illuminate\Http\JsonResponse;

/**
 * Class DoAddAction
 *
 * @package App\Http\SingleActions\Backend\Headquarters\DeveloperUsage\Schedule
 */
class DoAddAction extends BaseAction
{
    
    /**
     * @param  array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $this->model->fill($inputDatas);
        if ($this->model->save() === false) {
            throw new \Exception('302600');
        }
        StaticResource::saveSchedule();
        return msgOut();
    }
}
