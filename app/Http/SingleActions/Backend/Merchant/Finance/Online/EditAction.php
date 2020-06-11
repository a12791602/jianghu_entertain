<?php

namespace App\Http\SingleActions\Backend\Merchant\Finance\Online;

use App\Models\Finance\SystemFinanceOnlineInfo;
use App\Models\Finance\SystemFinanceUserTag;
use Arr;
use DB;
use Illuminate\Http\JsonResponse;

/**
 * Class EditAction
 * @package App\Http\SingleActions\Backend\Merchant\Finance\Online
 */
class EditAction extends BaseAction
{
    /**
     * @param array $inputData InputData.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputData): JsonResponse
    {
        $inputData['platform_sign']  = $this->currentPlatformEloq->sign;
        $inputData['last_editor_id'] = $this->user->id;
        $tags                        = $inputData['tags'] ?? null;
        Arr::forget($inputData, ['tags']);
        $model = $this->model->find($inputData['id']);
        if (!$model instanceof SystemFinanceOnlineInfo) {
            throw new \Exception('201401');
        }
        $condition = [
                      'platform_id'       => $this->currentPlatformEloq->id,
                      'online_finance_id' => $inputData['id'],
                     ];
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
        throw new \Exception('201401');
    }
}
