<?php

namespace App\Http\SingleActions\Backend\Headquarters\DeveloperUsage\SystemBank;

use Illuminate\Http\JsonResponse;

/**
 * Class EditAction
 *
 * @package App\Http\SingleActions\Backend\Headquarters\DeveloperUsage\SystemBank
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
        if ($model === null) {
            throw new \Exception('300905');
        }
        $inputDatas['last_editor_id'] = $this->user->id;
        $model->fill($inputDatas);
        if (!$model->save()) {
            throw new \Exception('300901');
        }
        $msgOut = msgOut();
        return $msgOut;
    }
}
