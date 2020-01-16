<?php

namespace App\Http\SingleActions\Backend\Merchant\Finance\Online;

use App\Http\Controllers\BackendApi\BackEndApiMainController;
use App\Models\Finance\SystemFinanceType;
use App\Models\Finance\SystemFinanceUserTag;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

/**
 * Class DelDoAction
 * @package App\Http\SingleActions\Backend\Merchant\Finance\Online
 */
class DelDoAction extends BaseAction
{
    /**
     * @param BackEndApiMainController $contll     Contll.
     * @param array                    $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(BackEndApiMainController $contll, array $inputDatas): JsonResponse
    {
        try {
            DB::beginTransaction();
            $onlineDel   = $this->model->where('id', $inputDatas['id'])->delete();
            $userTagsDel = SystemFinanceUserTag::where('finance_id', $inputDatas['id'])
                ->where('platform_id', $contll->currentPlatformEloq->id)
                ->where('is_online', SystemFinanceType::IS_ONLINE_YES)
                ->delete();
            $flag        = $onlineDel && $userTagsDel;
        } catch (\Throwable $exception) {
            $flag = false;
        }
        if ($flag) {
            DB::commit();
            $msgOut = msgOut();
            return $msgOut;
        }
        DB::rollBack();
        throw new \Exception('201402');
    }
}
