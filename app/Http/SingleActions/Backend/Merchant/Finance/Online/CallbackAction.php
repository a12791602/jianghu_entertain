<?php

namespace App\Http\SingleActions\Backend\Merchant\Finance\Online;

use App\Models\Finance\SystemFinanceChannel;
use App\Models\Finance\SystemFinanceOnlineInfo;
use App\Models\Finance\SystemFinanceVendor;
use App\Models\Systems\SystemIpWhiteList;
use App\Models\User\FrontendUser;
use App\Models\User\FrontendUsersAccount;
use App\Models\User\UsersRechargeOrder;
use App\Services\FactoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Class CallbackAction
 * @package App\Http\SingleActions\Backend\Merchant\Finance\Online
 */
class CallbackAction
{

    /**
     * 接收的回调数据
     *
     * @var mixed $inputDatas;
     */
    protected $inputDatas;

    /**
     * 请求的ip
     *
     * @var string|null $remoteIp
     */
    protected $remoteIp;

    /**
     * 订单号
     *
     * @var string $order
     */
    protected $order;

    /**
     * 系统的平台
     *
     * @var string $platform
     */
    protected $platform;

    /**
     * 回调订单的详情
     *
     * @var UsersRechargeOrder $orderInfo
     */
    protected $orderInfo;

    /**
     * CallbackAction constructor.
     * @param Request $request Request.
     */
    public function __construct(Request $request)
    {
        $this->inputDatas = $request->input();
        $this->remoteIp   = $request->ip();
    }

    /**
     * @param string $platform 系统平台.
     * @param string $order    系统订单号.
     * @return string
     */
    public function execute(string $platform, string $order): string
    {
        $this->order    = $order;
        $this->platform = $platform;
        $this->_writeLog('finance-callback-data', $order, '回调参数', $this->inputDatas);
        try {
            $result = $this->_preVerify();
            if (!$result) {
                return '403';
            }
            $result = $this->handleVerify();
            if (!$result) {
                return '500';
            }
            if ($result['flag']) {
                DB::beginTransaction();
                $this->orderInfo->status      = UsersRechargeOrder::STATUS_SUCCESS;
                $this->orderInfo->real_money  = $result['realMoney'];
                $this->orderInfo->platform_no = $result['merchantOrderNo'];
                $saveRes                      = $this->orderInfo->save();
                $user                         = $this->orderInfo->user;
                if (!$user instanceof FrontendUser) {
                    $this->_writeLog('finance-callback-data', $order, '未找到对应用户');
                    return '500';
                }
                $account = $user->account;
                if (!$account instanceof FrontendUsersAccount) {
                    $this->_writeLog('finance-callback-data', $order, '对应用户账号异常');
                    return '500';
                }
                if ($saveRes) {
                    $account->operateAccount(
                        'recharge',
                        ['amount' => $this->orderInfo->arrive_money],
                    );
                    DB::commit();
                } else {
                    DB::rollBack();
                }
            }//end if
            return $result['backStr'];
        } catch (\Throwable $exception) {
            $data = [
                     'file'    => $exception->getFile(),
                     'line'    => $exception->getLine(),
                     'message' => $exception->getMessage(),
                    ];
            $this->_writeLog('finance-callback-system', $this->order, '系统错误!', $data);
            DB::rollBack();
            return '500';
        }//end try
    }

    /**
     * 检查数据
     * @return mixed
     */
    protected function handleVerify()
    {
        $onlineInfo = $this->orderInfo->onlineInfo;
        if (!$onlineInfo instanceof SystemFinanceOnlineInfo) {
            $this->_writeLog('finance-callback-data', $this->order, '未找到对应渠道');
            return false;
        }
        $channel = $onlineInfo->channel;
        if (!$channel instanceof SystemFinanceChannel) {
            $this->_writeLog('finance-callback-data', $this->order, '未找到对应通道');
            return false;
        }
        $vendor = $channel->vendor;
        if (!$vendor instanceof SystemFinanceVendor) {
            $this->_writeLog('finance-callback-data', $this->order, '未找到对应厂商');
            return false;
        }
        $vendor  = $vendor->sign; //第三方厂商
        $channel = $channel->sign; //通道
        $result  = FactoryService::getInstence()
            ->generatePay($vendor, $channel)
            ->setPreDataOfVerify($this->orderInfo)
            ->verify($this->inputDatas);
        //如果第三方返回的金额大于本系统的订单金额, 对不起, 为了安全, 按掉单处理.
        if ($result['realMoney'] > $this->orderInfo->money) {
            $this->_writeLog('finance-callback-data', $this->order, '回调的上分金额大于订单金额!');
            return false;
        }
        return $result;
    }

    /**
     * 验证签名前检验
     *
     * @return boolean
     */
    private function _preVerify(): bool
    {
        //检测回调参数是否正常
        if (empty($this->inputDatas)) {
            $this->_writeLog('finance-callback-system', $this->order, '回调参数异常,没有收到对方的参数!');
            return false;
        }
        $orderInfo = UsersRechargeOrder::where('platform_sign', $this->platform)
            ->where('order_no', $this->order)->first();
        //检测订单是否正常
        if (!$orderInfo) {
            $this->_writeLog('finance-callback-system', $this->order, '找不到对应的订单信息!');
            return false;
        }
        //如果订单状态不等于订单初始化时的状态, 对不起, 为了避免重复上分, 程序就此打住.
        if ((int) $orderInfo->status !== UsersRechargeOrder::STATUS_INIT) {
            $this->_writeLog('finance-callback-system', $this->order, '该订单已关闭!', $orderInfo->toArray());
            return false;
        }
        $onlineInfo = $this->orderInfo->onlineInfo;
        if (!$onlineInfo instanceof SystemFinanceOnlineInfo) {
            $this->_writeLog('finance-callback-system', $this->order, '未找到对应渠道');
            return false;
        }
        $channel = $onlineInfo->channel;
        if (!$channel instanceof SystemFinanceChannel) {
            $this->_writeLog('finance-callback-system', $this->order, '未找到对应通道');
            return false;
        }
        $vendor = $channel->vendor;
        if (!$vendor instanceof SystemFinanceVendor) {
            $this->_writeLog('finance-callback-system', $this->order, '未找到对应厂商');
            return false;
        }
        $whiteList = $vendor->whiteList;
        if (!$whiteList instanceof SystemIpWhiteList) {
            $this->_writeLog('finance-callback-system', $this->order, '未找到对应白名单');
            return false;
        }
        $whiteListIps = $whiteList->ips;
        //检测ip是否在自己厂商的ip白名单内
        if (empty($whiteListIps) || !in_array($this->remoteIp, $whiteListIps)) {
            $data = [
                     'remoteIp'     => $this->remoteIp,
                     'whiteListIps' => $whiteListIps,
                    ];
            $this->_writeLog('finance-callback-system', $this->order, 'IP不在白名单内!', $data);
            return false;
        }
        $this->orderInfo = $orderInfo;
        return true;
    }

    /**
     * 写日志.
     *
     * @param string $channel 通道.
     * @param string $orderNo 订单号.
     * @param string $msgs    消息.
     * @param array  $data    具体数据.
     * @return void
     */
    private function _writeLog(
        string $channel,
        string $orderNo,
        string $msgs,
        array $data = []
    ): void {
        Log::channel($channel)->info('回调日志', ['orderNo' => $orderNo, 'msg' => $msgs, 'data' => $data]);
    }
}
