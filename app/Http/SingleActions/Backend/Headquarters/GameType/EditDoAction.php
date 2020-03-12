<?php

namespace App\Http\SingleActions\Backend\Headquarters\GameType;

use Arr;
use Illuminate\Http\JsonResponse;

/**
 * Class EditDoAction
 *
 * @package App\Http\SingleActions\Backend\Headquarters\GameType
 */
class EditDoAction
{

    /**
     * @param  array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $model = $inputDatas['model']::find($inputDatas['id']);
        $model->fill(Arr::only($inputDatas, ['id', 'name', 'sign']));
        if (!$model->save()) {
            throw new \Exception('300403');
        }
        $msgOut = msgOut();
        return $msgOut;
    }
}
