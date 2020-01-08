<?php

namespace App\Http\SingleActions\Frontend\H5\Recharge;

use App\Http\Controllers\FrontendApi\FrontendApiMainController;
use App\Models\Finance\SystemFinanceOfflineInfo;
use App\Models\Finance\SystemFinanceOnlineInfo;
use App\Models\Finance\SystemFinanceType;
use App\Models\Order\UsersRechargeOrder;
use App\Services\FactoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

/**
 * Class RechargeAction
 * @package App\Http\SingleActions\Frontend\H5\Recharge
 */
class RechargeAction
{

    /**
     * @var array $inputDatas
     */
    protected $inputDatas;

    /**
     * @var FrontendApiMainController $contll
     */
    protected $contll;

    /**
     * @var mixed $model
     */
    protected $model;

    /**
     * @var array $order
     */
    protected $order;

    public const STUTAS_NO = 0;

    /**
     * @param FrontendApiMainController $contll     Contll.
     * @param array                     $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(FrontendApiMainController $contll, array $inputDatas): JsonResponse
    {
        $this->contll     = $contll;
        $this->inputDatas = $inputDatas;
        //获取模型
        $this->_getModel();
        //前置检查
        $this->_preCheck();
        //生成订单数据
        $data = $this->_generateOrderData();
        //保存订单
        if ((int) $this->inputDatas['is_online'] === SystemFinanceType::IS_ONLINE_YES) {
            $order        = $this->_saveOnlineOrderData($data);
            $platformSign = $this->model->channel->vendor->sign; //第三方平台厂商的标记
            $channelSign  = $this->model->channel->sign; //第三方通道的标记
            try {
                $result = FactoryService::getInstence()
                    ->generatePay($platformSign, $channelSign)
                    ->setPreDataOfRecharge($order)
                    ->recharge();
            } catch (\Throwable $exception) {
                throw new \Exception('100300');
            }
            return $result;
        }

        if ((int) $this->inputDatas['is_online'] === SystemFinanceType::IS_ONLINE_NO) {
            $result = $this->_saveOfflineOrderData($data);
            $result = msgOut(true, $result);
            return $result;
        }
    }

    /**
     * @return void
     */
    private function _getModel(): void
    {
        if ((int) $this->inputDatas['is_online'] === SystemFinanceType::IS_ONLINE_YES) {
            $this->model = SystemFinanceOnlineInfo::find($this->inputDatas['channel_id']);
        } elseif ((int) $this->inputDatas['is_online'] === SystemFinanceType::IS_ONLINE_NO) {
            $this->model = SystemFinanceOfflineInfo::find($this->inputDatas['channel_id']);
        }
    }

    /**
     * @return void
     * @throws \Exception Exception.
     */
    private function _preCheck(): void
    {
        $this->_checkChannelIsOpen();
        $this->_checkMoneyIsEffective();
    }

    /**
     * 检查通道是否开启
     * @return void
     * @throws \Exception Exception.
     */
    private function _checkChannelIsOpen(): void
    {
        if ((int) $this->inputDatas['is_online'] === SystemFinanceType::IS_ONLINE_YES) {
            if ((int) ($this->model->status && $this->model->channel->status) === self::STUTAS_NO) {
                throw new \Exception('100300');
            }
        } elseif ((int) $this->inputDatas['is_online'] === SystemFinanceType::IS_ONLINE_NO) {
            if ((int) $this->model->status === self::STUTAS_NO) {
                throw new \Exception('100300');
            }
        }
    }

    /**
     * 检查金额是否有效
     * @return void
     * @throws \Exception Exception.
     */
    private function _checkMoneyIsEffective(): void
    {
        if ($this->inputDatas['money'] < $this->model->min || $this->inputDatas['money'] > $this->model->max) {
            throw new \Exception('100301');
        }
    }

    /**
     * 保存线下订单
     * @param array $data Data.
     * @return mixed[]
     * @throws \Exception Exception.
     */
    private function _saveOfflineOrderData(array $data): array
    {
        $platformSign = $this->contll->currentPlatformEloq->sign;
        $order        = UsersRechargeOrder::where('status', UsersRechargeOrder::STATUS_INIT)
            ->where('money', $this->inputDatas['money'])
            ->where('finance_channel_id', $this->inputDatas['channel_id'])
            ->where('platform_sign', $platformSign)
            ->where('is_online', SystemFinanceType::IS_ONLINE_NO)
            ->where('real_money', $data['real_money'])->first();
        if ($order) {
            $data['real_money'] = $this->_getRealMoney();
            $result             = $this->_saveOfflineOrderData($data);
            return $result;
        }
        $returnData              = [];
        $usersRechargeOrderModel = new UsersRechargeOrder();
        $usersRechargeOrderModel->fill($data);
        $result = $usersRechargeOrderModel->save();
        if (!$result) {
            throw new \Exception('100303');
        }
        $lastId                   = $usersRechargeOrderModel->id;
        $order                    = UsersRechargeOrder::find($lastId);
        $returnData['account']    = $this->model->account;
        $returnData['username']   = $this->model->username;
        $returnData['branch']     = $this->model->branch;
        $returnData['real_money'] = $order->real_money;
        $returnData['money']      = $order->money;
        $returnData['order_no']   = $order->order_no;
        $returnData['qrcode']     = $this->model->qrcode;
        $returnData['created_at'] = $order->created_at->toDateTimeString();
        $returnData['expired_at'] = $order->created_at
            ->addMinutes(UsersRechargeOrder::EXPIRED)->toDateTimeString();
        return $returnData;
    }

    /**
     * 保存线上订单
     * @param array $data Data.
     * @return UsersRechargeOrder
     * @throws \Exception Exception.
     */
    private function _saveOnlineOrderData(array $data): UsersRechargeOrder
    {
        $usersRechargeOrderModel = new UsersRechargeOrder();
        $usersRechargeOrderModel->fill($data);
        $result = $usersRechargeOrderModel->save();
        if (!$result) {
            throw new \Exception('100303');
        }
        $lastId = $usersRechargeOrderModel->id;
        $order  = UsersRechargeOrder::find($lastId);
        return $order;
    }

    /**
     * 生成订单数据
     * @return mixed[]
     * @throws \Exception Exception.
     */
    private function _generateOrderData(): array
    {
        $data                       = [];
        $platformSign               = $this->contll->currentPlatformEloq->sign;
        $data['platform_sign']      = $platformSign;
        $data['user_id']            = $this->contll->frontendUser->id;
        $data['order_no']           = $this->_generateOrderNo($platformSign);
        $data['finance_channel_id'] = $this->inputDatas['channel_id'];
        $data['money']              = $this->inputDatas['money'];
        if ((int) $this->inputDatas['is_online'] === SystemFinanceType::IS_ONLINE_YES) {
            $data['finance_type_id'] = $this->model->channel->type_id;
            $data['handling_money']  = $this->model->handle_fee;
            $data['arrive_money']    = $data['money'] - $data['handling_money'];
        } elseif ((int) $this->inputDatas['is_online'] === SystemFinanceType::IS_ONLINE_NO) {
            $data['finance_type_id'] = $this->model->type_id;
            $data['real_money']      = $this->_getRealMoney();
            $data['handling_money']  = $this->model->handle_fee;
            $data['arrive_money']    = $data['money'] - $data['handling_money'];
        }
        $data['status']    = UsersRechargeOrder::STATUS_INIT;
        $data['is_online'] = $this->inputDatas['is_online'];
        $data['client_ip'] = $this->inputDatas['ip'];
        return $data;
    }

    /**
     * 获取订单号
     * @param string $platformSign PlatformSign.
     * @return integer
     */
    private function _generateOrderNo(string $platformSign): int
    {
        $init     = strtotime('2020-01-01 00:00:00') * 10;
        $orderKey = $platformSign . '_recharge_order_no';
        if (!Cache::get($orderKey)) {
            Cache::put($orderKey, $init);
        }
        $orderNo = Cache::increment($orderKey);
        return $orderNo;
    }

    /**
     * 获取真实转账金额
     * @return float
     * @throws \Exception Exception.
     */
    private function _getRealMoney(): float
    {
        $platformSign = $this->contll->currentPlatformEloq->sign;
        $orders       = UsersRechargeOrder::where('status', UsersRechargeOrder::STATUS_INIT)
            ->where('money', $this->inputDatas['money'])
            ->where('finance_channel_id', $this->inputDatas['channel_id'])
            ->where('platform_sign', $platformSign)
            ->where('is_online', SystemFinanceType::IS_ONLINE_NO)
            ->select('real_money')
            ->get()
            ->pluck('real_money')
            ->toArray();
        $exists       = []; //已经存在的
        foreach ($orders as $order) {
            $money    = round($order - $this->inputDatas['money'], 2);
            $exists[] = $money;
        }
        $allNum = range(-0.99, 0.99, 0.01); //所有的
        $diff   = array_diff($allNum, $exists);
        if (empty($diff)) {
            throw new \Exception('100302');
        }
        $randKey   = array_rand($diff);
        $realMoney = $diff[$randKey] + $this->inputDatas['money'];
        return $realMoney;
    }
}
