<?php

namespace App\Http\SingleActions\Backend\Headquarters\GameType;

use App\Models\Game\GameTypePlatform;
use App\Models\Systems\SystemPlatform;
use Arr;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Log;

/**
 * Class AddDoAction
 *
 * @package App\Http\SingleActions\Backend\Headquarters\GameType
 */
class AddDoAction extends BaseAction
{
    
    /**
     * @param  array $inputDatas InputDatas.
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        try {
            DB::beginTransaction();
            $item       = $inputDatas['model']::create(Arr::only($inputDatas, ['name', 'sign', 'status']));
            $insertData = $this->_getFormatDataForTypePlatform($item->id);
            GameTypePlatform::insert($insertData);
            DB::commit();
            $msgOut = msgOut();
            return $msgOut;
        } catch (\Throwable $throwable) {
            Log::error($throwable->getMessage());
        }
        DB::rollBack();
        throw new \Exception('300402');
    }

    /**
     * @param  integer $typeId TypeId.
     * @return mixed[]
     */
    private function _getFormatDataForTypePlatform(int $typeId): array
    {
        $data      = [];
        $platforms = SystemPlatform::get(['id'])->toArray();
        foreach ($platforms as $platform) {
            $tmpData           = [
                                  'type_id'     => $typeId,
                                  'platform_id' => $platform['id'],
                                  'device'      => GameTypePlatform::DEVICE_H5,
                                 ];
            $data[]            = $tmpData;
            $tmpData['device'] = GameTypePlatform::DEVICE_APP;
            $data[]            = $tmpData;
            $tmpData['device'] = GameTypePlatform::DEVICE_PC;
            $data[]            = $tmpData;
        }
        return $data;
    }
}
