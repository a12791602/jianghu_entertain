<?php

namespace App\Http\SingleActions\Backend\Headquarters\Game\GameVendor;

use App\Models\Game\GameVendorPlatform;
use App\Models\Systems\SystemIpWhiteList;
use App\Models\Systems\SystemPlatform;
use Arr;
use DB;
use Illuminate\Http\JsonResponse;
use Log;

/**
 * Class AddDoAction
 *
 * @package App\Http\SingleActions\Backend\Headquarters\GameVendor
 */
class AddDoAction extends BaseAction
{
    
    /**
     * @param  array $inputData InputData.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputData): JsonResponse
    {
        $inputData['author_id'] = $this->user->id;
        $whitelist_ips           = $inputData['whitelist_ips'];
        Arr::forget($inputData,'whitelist_ips');
        $this->model->fill($inputData);
        DB::beginTransaction();
        try {
            if ($this->model->save()) {
                $insertData = $this->_getFormatDataForVendorPlatform($this->model->id);
                SystemIpWhiteList::create(
                    [
                     'ips'            => $whitelist_ips,
                     'type'           => SystemIpWhiteList::WHITELIST_IP_TYPE_VENDOR,
                     'game_vendor_id' => $this->model->id,
                    ]
                );
                GameVendorPlatform::insert($insertData);
                DB::commit();
            }
            return msgOut();
        } catch (\Throwable $exception) {
            Log::error($exception->getMessage());
        }
        DB::rollBack();
        throw new \Exception('300302');
    }

    /**
     * @param  integer $vendorId VendorId.
     * @return mixed[]
     */
    private function _getFormatDataForVendorPlatform(int $vendorId): array
    {
        $data      = [];
        $platforms = SystemPlatform::get(['id'])->toArray();
        foreach ($platforms as $platform) {
            $tmpData           = [
                'vendor_id'     => $vendorId,
                'platform_id' => $platform['id'],
                'device'      => GameVendorPlatform::DEVICE_H5,
            ];
            $data[]            = $tmpData;
            $tmpData['device'] = GameVendorPlatform::DEVICE_APP;
            $data[]            = $tmpData;
            $tmpData['device'] = GameVendorPlatform::DEVICE_PC;
            $data[]            = $tmpData;
        }
        return $data;
    }
}
