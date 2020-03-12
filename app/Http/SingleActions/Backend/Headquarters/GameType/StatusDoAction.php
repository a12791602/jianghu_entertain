<?php

namespace App\Http\SingleActions\Backend\Headquarters\GameType;

use Illuminate\Http\JsonResponse;
use Log;

/**
 * Class StatusDoAction
 *
 * @package App\Http\SingleActions\Backend\Headquarters\GameType
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
        try {
            $model         = $inputDatas['model']::find($inputDatas['id']);
            $model->status = $inputDatas['status'];
            $model->save();
            $msgOut = msgOut();
            return $msgOut;
        } catch (\Throwable $throwable) {
            Log::error($throwable->getMessage());
        }
        throw new \Exception('300404');
    }
}
