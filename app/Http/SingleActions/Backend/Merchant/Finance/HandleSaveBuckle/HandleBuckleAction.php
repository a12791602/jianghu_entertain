<?php

namespace App\Http\SingleActions\Backend\Merchant\Finance\HandleSaveBuckle;

use App\Models\User\FrontendUser;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

/**
 * Class HandleBuckleAction
 * @package App\Http\SingleActions\Backend\Merchant\Finance\HandleSaveBuckle
 */
class HandleBuckleAction extends BaseAction
{
    /**
     * @param array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $platformSign = $this->currentPlatformEloq->sign;
        $user         = FrontendUser::where('mobile', $inputDatas['user'])
            ->orWhere('guid', $inputDatas['user'])
            ->where('platform_sign', $platformSign)->first();
        if (!$user) {
            throw new \Exception('202400');
        }
        $data                  = [];
        $data['order_no']      = $this->generateOrderNo($platformSign);
        $data['user_id']       = $user->id;
        $data['type']          = $inputDatas['type'];
        $data['platform_sign'] = $platformSign;
        $data['money']         = $inputDatas['money'];
        $data['remark']        = $inputDatas['remark'] ?? '';
        $data['admin_id']      = $this->user->id;
        $data['balance']       = $user->account->balance - $inputDatas['money'];
        $data['direction']     = $this->model::DIRECTION_OUT;
        DB::beginTransaction();
        try {
            $this->model->fill($data);
            if ($this->model->save()) {
                $user->account->operateAccount(
                    ['amount' => $inputDatas['money']],
                    'artificial_deduction',
                );
                DB::commit();
                $msgOut = msgOut();
                return $msgOut;
            }
        } catch (\Throwable $exception) {
            $this->writeLog($exception, $data['order_no']);
        }
        DB::rollBack();
        throw new \Exception('202402');
    }
}
