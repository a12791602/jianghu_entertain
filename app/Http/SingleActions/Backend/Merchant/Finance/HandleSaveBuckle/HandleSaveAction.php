<?php

namespace App\Http\SingleActions\Backend\Merchant\Finance\HandleSaveBuckle;

use App\Models\User\FrontendUser;
use Illuminate\Http\JsonResponse;

/**
 * Class HandleSaveAction
 * @package App\Http\SingleActions\Backend\Merchant\Finance\HandleSaveBuckle
 */
class HandleSaveAction extends BaseAction
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
        if (!$user || !$user->account) {
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
        $data['balance']       = $user->account->balance + $inputDatas['money'];
        $data['direction']     = $this->model::DIRECTION_IN;
        try {
            $this->model->fill($data);
            if ($this->model->save()) {
                $param = [
                          'user_id' => $this->user->id,
                          'amount'  => $inputDatas['money'],
                         ];
                $user->account->operateAccount('artificial_recharge', $param);
                return msgOut();
            }
        } catch (\Throwable $exception) {
            $this->writeLog($exception, $data['order_no']);
        }
        throw new \Exception('202401');
    }
}
