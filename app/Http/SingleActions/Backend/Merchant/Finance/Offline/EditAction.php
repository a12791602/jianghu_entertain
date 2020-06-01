<?php

namespace App\Http\SingleActions\Backend\Merchant\Finance\Offline;

use App\Models\Finance\SystemFinanceOfflineInfo;
use App\Models\Finance\SystemFinanceUserTag;
use Arr;
use DB;
use Illuminate\Http\JsonResponse;

/**
 * Class EditAction
 * @package App\Http\SingleActions\Backend\Merchant\Finance\Offline
 */
class EditAction extends BaseAction
{
    /**
     * ***
     * @param array $inputData InputData.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputData): JsonResponse
    {
        $inputData['platform_id']    = $this->currentPlatformEloq->id;
        $inputData['last_editor_id'] = $this->user->id;
        $tags                        = $inputData['tags'];
        Arr::forget($inputData, ['tags']);
        $model = $this->model->find($inputData['id']);
        if (!$model instanceof SystemFinanceOfflineInfo) {
            throw new \Exception('200600');
        }
        $condition                       = [];
        $condition['platform_id']        = $this->currentPlatformEloq->id;
        $condition['offline_finance_id'] = $inputData['id'];
        DB::beginTransaction();
        try {
            if ($model->update($inputData)) {
                SystemFinanceUserTag::where($condition)->update(['tag_id' => $tags]);
                DB::commit();
                return msgOut();
            }
        } catch (\Throwable $exception) {
            \Log::error($exception->getMessage());
        }
        DB::rollBack();
        throw new \Exception('200600');
    }
}
