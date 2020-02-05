<?php

namespace App\Http\SingleActions\Backend\Merchant\Finance\Offline;

use App\Models\Finance\SystemFinanceType;
use App\Models\Finance\SystemFinanceUserTag;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

/**
 * Class DelDoAction
 * @package App\Http\SingleActions\Backend\Merchant\Finance\Offline
 */
class DelDoAction extends BaseAction
{
    /**
     * ***
     * @param array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        try {
            DB::beginTransaction();
            $offlineDel  = $this->model->where('id', $inputDatas['id'])->delete();
            $userTagsDel = SystemFinanceUserTag::where('finance_id', $inputDatas['id'])
                ->where('platform_id', $this->currentPlatformEloq->id)
                ->where('is_online', SystemFinanceType::IS_ONLINE_NO)
                ->delete();
            $flag        = $offlineDel && $userTagsDel;
        } catch (\Throwable $exception) {
            $flag = false;
        }
        if ($flag) {
            DB::commit();
            $msgOut = msgOut();
            return $msgOut;
        }
        DB::rollBack();
        throw new \Exception('200601');
    }
}
