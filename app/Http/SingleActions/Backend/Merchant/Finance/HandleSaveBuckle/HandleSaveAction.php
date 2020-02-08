<?php

namespace App\Http\SingleActions\Backend\Merchant\Finance\HandleSaveBuckle;

use App\Models\User\FrontendUser;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        if (!$user) {
            throw new \Exception('202400');
        }
        $data                  = [];
        $data['order_no']      = $this->_generateOrderNo($platformSign);
        $data['user_id']       = $user->id;
        $data['type']          = $inputDatas['type'];
        $data['platform_sign'] = $platformSign;
        $data['money']         = $inputDatas['money'];
        $data['remark']        = $inputDatas['remark'] ?? '';
        $data['admin_id']      = $this->user->id;
        $data['balance']       = $user->account->balance + $inputDatas['money'];
        $data['direction']     = $this->model::DIRECTION_IN;
        DB::beginTransaction();
        try {
            $this->model->fill($data);
            if ($this->model->save()) {
                $user->account->operateAccount(
                    ['amount' => $inputDatas['money']],
                    'recharge',
                );
                DB::commit();
                $msgOut = msgOut();
                return $msgOut;
            }
        } catch (\Throwable $exception) {
            $this->_writeLog($exception, $data);
        }
        DB::rollBack();
        throw new \Exception('202401');
    }

    /**
     * 生成订单号.
     *
     * @param string $platformSign 所属平台标记.
     * @return integer
     */
    private function _generateOrderNo(string $platformSign): int
    {
        $init     = strtotime('2020-01-01 00:00:00') * 10;
        $orderKey = $platformSign . '_handle_save_buckle_order_no';
        if (!Cache::get($orderKey)) {
            Cache::put($orderKey, $init);
        }
        $orderNo = Cache::increment($orderKey);
        return $orderNo;
    }

    /**
     * 记录异常日志.
     *
     * @param \Throwable $exception 异常对象.
     * @param mixed[]    $data      订单数据.
     * @return void
     */
    private function _writeLog(\Throwable $exception, array $data): void
    {
        $error   = [
                    'file'    => $exception->getFile(),
                    'line'    => $exception->getLine(),
                    'message' => $exception->getMessage(),
                   ];
        $logData = [
                    'orderNo' => $data['order_no'],
                    'msg'     => '人工存款失败',
                    'data'    => $error,
                   ];
        Log::channel('finance-recharge-system')->info(json_encode($logData));
    }
}
