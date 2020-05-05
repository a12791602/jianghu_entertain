<?php

namespace App\Http\SingleActions\Backend\Headquarters\Game\GameVendor;

use App\Models\Game\GameVendor;
use App\Models\Systems\SystemIpWhiteList;
use Arr;
use Illuminate\Http\JsonResponse;
use Jenssegers\Agent\Agent;
use Log;

/**
 * Class EditDoAction
 *
 * @package App\Http\SingleActions\Backend\Headquarters\GameVendor
 */
class EditDoAction extends BaseAction
{
    
    /**
     * @param  array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $model = $this->model->find($inputDatas['id']);
        try {
            if ($model instanceof GameVendor) {
                $inputDatas['last_editor_id'] = $this->user->id;
                $whitelist_ids_item           = [
                    'ips'  => $inputDatas['whitelist_ips'],
                    'type' => SystemIpWhiteList::WHITELIST_IP_TYPE_VENDOR,
                ];
                SystemIpWhiteList::updateOrCreate(['game_vendor_id' => $inputDatas['id']], $whitelist_ids_item);
                Arr::forget($inputDatas, 'whitelist_ips');
                $model->update($inputDatas);
                return msgOut();
            }
        } catch (\Exception $e) {
            Log::error($e);
        }
        throw new \Exception('300303');
    }
}
