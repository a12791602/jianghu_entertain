<?php

namespace App\Http\SingleActions\Backend\Headquarters\Game\GameVendor;

use App\Models\Game\GameVendor;
use App\Models\Systems\SystemIpWhiteList;
use Arr;
use Illuminate\Http\JsonResponse;
use Log;

/**
 * Class StatusDoAction
 *
 * @package App\Http\SingleActions\Backend\Headquarters\GameVendor
 */
class StatusDoAction extends BaseAction
{
    
    /**
     * @param  array $inputDatas InputData.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $model = $this->model->find($inputDatas['id']);
        try {
            if ($model instanceof GameVendor) {
                $inputDatas['last_editor_id'] = $this->user->id;
                $model->update($inputDatas);
                return msgOut();
            }
        } catch (\Exception $exception) {
            Log::error($exception);
        }
        throw new \Exception('300303');
    }
}
