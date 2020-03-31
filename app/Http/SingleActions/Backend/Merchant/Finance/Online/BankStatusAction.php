<?php

namespace App\Http\SingleActions\Backend\Merchant\Finance\Online;

use App\Models\Finance\SystemPlatformBank;
use Illuminate\Http\JsonResponse;
use Log;

/**
 * Class BankManagementAction
 * @package App\Http\SingleActions\Backend\Merchant\Finance\Online
 */
class BankStatusAction extends BaseAction
{
    /**
     * @param array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \RuntimeException Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        try {
            $platformSign               = $this->currentPlatformEloq->sign;
            $condition                  = [];
            $condition['id']            = $inputDatas['id'];
            $condition['platform_sign'] = $platformSign;
            SystemPlatformBank::where($condition)
                ->update(
                    [
                     'status'         => $inputDatas['status'],
                     'last_editor_id' => $this->user->id,
                    ],
                );
            return msgOut();
        } catch (\RuntimeException $exception) {
            Log::error($exception->getMessage());
        }
        throw new \RuntimeException('201403');
    }
}
