<?php

namespace App\Http\SingleActions\Backend\Merchant\Finance\HandleSaveBuckle;

use App\Http\SingleActions\MainAction;
use App\Models\Finance\SystemFinanceHandleSaveBuckleRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

/**
 * Class BaseAction
 * @package App\Http\SingleActions\Backend\Merchant\Finance\HandleSaveBuckle
 */
class BaseAction extends MainAction
{

    /**
     * @var SystemFinanceHandleSaveBuckleRecord $model
     */
    protected $model;

    /**
     * BaseAction constructor.
     * @param SystemFinanceHandleSaveBuckleRecord $systemFinanceHandleSaveBuckleRecord 模型.
     * @param Request                             $request                             请求.
     */
    public function __construct(
        SystemFinanceHandleSaveBuckleRecord $systemFinanceHandleSaveBuckleRecord,
        Request $request
    ) {
        parent::__construct($request);
        $this->model = $systemFinanceHandleSaveBuckleRecord;
    }

    /**
     * 记录异常日志.
     *
     * @param \Throwable $exception 异常对象.
     * @param integer    $orderNo   订单号.
     * @return void
     */
    protected function writeLog(\Throwable $exception, int $orderNo): void
    {
        $error   = [
                    'file'    => $exception->getFile(),
                    'line'    => $exception->getLine(),
                    'message' => $exception->getMessage(),
                   ];
        $logData = [
                    'orderNo' => $orderNo,
                    'msg'     => '人工存款失败',
                    'data'    => $error,
                   ];
        Log::channel('finance-recharge-system')->info(json_encode($logData));
    }

    /**
     * 生成订单号.
     *
     * @param string $platformSign 所属平台标记.
     * @return integer
     */
    protected function generateOrderNo(string $platformSign): int
    {
        $init     = strtotime('2020-01-01 00:00:00') * 10;
        $orderKey = $platformSign . '_handle_save_buckle_order_no';
        if (!Cache::get($orderKey)) {
            Cache::put($orderKey, $init);
        }
        $orderNo = Cache::increment($orderKey);
        return $orderNo;
    }
}
