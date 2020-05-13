<?php

namespace App\Http\SingleActions\Backend\Headquarters\Game\GameVendor;

use App\Models\Game\GameVendor;
use App\Models\Game\GameVendorPlatform;
use App\Models\Systems\StaticResource;
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
     * @param  array $inputData InputData.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputData): JsonResponse
    {
        $model = $this->model->find($inputData['id']);
        if (!$model instanceof GameVendor) {
            throw new \Exception('300303');
        }
        $inputData['last_editor_id'] = $this->user->id;
        $whitelist_ids_item          = [
                                        'ips'  => $inputData['whitelist_ips'],
                                        'type' => SystemIpWhiteList::WHITELIST_IP_TYPE_VENDOR,
                                       ];
        try {
            SystemIpWhiteList::updateOrCreate(['game_vendor_id' => $inputData['id']], $whitelist_ids_item);
            Arr::forget($inputData, 'whitelist_ips');
            $model->update($inputData);
            return msgOut();
        } catch (\Exception $e) {
            Log::error($e);
        }
        throw new \Exception('300303');
    }
}
