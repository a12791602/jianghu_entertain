<?php

namespace App\Http\SingleActions\Backend\Headquarters\GameVendor;

use App\Models\Game\GameVendorPlatform;
use App\Models\Systems\SystemPlatform;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

/**
 * Class AddDoAction
 *
 * @package App\Http\SingleActions\Backend\Headquarters\GameVendor
 */
class AddDoAction extends BaseAction
{
    
    /**
     * @param  array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $flag = false;
        try {
            $inputDatas['author_id'] = $this->user->id;
            DB::beginTransaction();
            $this->model->fill($inputDatas);
            if ($this->model->save()) {
                $insertData = $this->_getFormatDataForVendorPlatform($this->model->id);
                GameVendorPlatform::insert($insertData);
                $flag = true;
            }
        } catch (\Throwable $exception) {
            $flag = false;
        }
        if (!$flag) {
            DB::rollBack();
            throw new \Exception('300302');
        }
        DB::commit();
        $msgOut = msgOut();
        return $msgOut;
    }

    /**
     * @param  integer $vendorId VendorId.
     * @return mixed[]
     */
    private function _getFormatDataForVendorPlatform(int $vendorId): array
    {
        $data      = [];
        $platforms = SystemPlatform::select('id')->get()->toArray();
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
