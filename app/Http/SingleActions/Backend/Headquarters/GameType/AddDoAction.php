<?php

namespace App\Http\SingleActions\Backend\Headquarters\GameType;

use App\Http\Requests\Backend\Headquarters\GameType\AddDoRequest;
use App\Models\Game\GameTypePlatform;
use App\Models\Systems\SystemPlatform;
use Arr;
use DB;
use Illuminate\Http\JsonResponse;
use Log;

/**
 * Class AddDoAction
 *
 * @package App\Http\SingleActions\Backend\Headquarters\GameType
 */
class AddDoAction
{

    /**
     * @param AddDoRequest $request AddDoRequest.
     * @return \Illuminate\Http\JsonResponse
     * @throws \RuntimeException Exception.
     */
    public function execute(AddDoRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();
            $validated  = $request->validated();
            $model      = $request->get('model'); // 从 App\Rules\Backend\Common\Sortable\CheckSortableModel 注入
            $item       = $model::create(Arr::only($validated, ['name', 'sign', 'status']));
            $insertData = $this->_getFormatDataForTypePlatform($item->id);
            GameTypePlatform::insert($insertData);
            DB::commit();
            $msgOut = msgOut();
            return $msgOut;
        } catch (\RuntimeException $exception) {
            Log::error($exception->getMessage());
        }
        DB::rollBack();
        throw new \RuntimeException('300402');
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
