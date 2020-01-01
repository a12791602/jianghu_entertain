<?php

namespace App\Lib\Logic;

use App\Models\User\FrontendUser;
use App\Models\User\FrontendUsersAccount;
use App\Models\User\FrontendUsersAccountsReport;
use App\Models\User\FrontendUsersAccountsReportsParamsWithValue;
use App\Models\User\FrontendUsersAccountsType;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

/**
 * 帐变主逻辑
 * Class AccountChange
 * @package App\Lib\Logic
 */
class AccountChange
{
    public const FROZEN_STATUS_OUT  = 1; //冻结
    public const FROZEN_STATUS_BACK = 2; //解冻

    /**
     * @var FrontendUsersAccount
     */
    protected $account;

    /**
     * @param FrontendUsersAccount $account 账户Model.
     */
    public function __construct(FrontendUsersAccount $account)
    {
        $this->account = $account;
    }

    /**
     * @param string $typeSign 帐变类型.
     * @param array  $params   参数.
     * @return mixed
     */
    public function doChange(string $typeSign, array $params)
    {
        $user       = $this->account->frontendUser;
        $typeConfig = FrontendUsersAccountsType::getTypeBySign($typeSign);
        //　1. 获取帐变配置
        $paramsValidator = FrontendUsersAccountsType::getParamToTransmit($typeSign);
        // 2. 参数检测
        $validator = Validator::make($params, $paramsValidator);
        if ($validator->fails()) {
            $return = 'doChange' . $validator->errors()->first();
            return $return;
        }
        // 3. 检测金额
        $amount = abs($params['amount']);
        if ((bool) $amount === false) {
            return true;
        }
        // 冻结类型 1 冻结自己金额 2 冻结退还
        // 资金增减. 需要检测对应
        $beforeBalance = $this->account->balance;
        $beforeFrozen  = $this->account->frozen;
        $amount        = (float) $amount;
        // 根据冻结类型处理
        $return = $this->_handleFrozen($typeConfig, $amount);
        if ($return !== true) {
            return '对不起, 账户异常(' . $return . ')!';
        }
        // 修改数据
        $saveData = $this->_saveData(
            $params,
            $typeConfig,
            $user,
            $beforeBalance,
            $beforeFrozen,
            $validator->validated(),
        );
        return $saveData;
    }

    /**
     * 根据冻结类型处理
     * @param  array $typeConfig 帐变类型Arr.
     * @param  float $amount     金额.
     * @return mixed
     */
    private function _handleFrozen(array $typeConfig, float $amount)
    {
        switch ($typeConfig['frozen_type']) {
            case self::FROZEN_STATUS_OUT:
                $return = $this->frozen($amount);
                break;
            case self::FROZEN_STATUS_BACK:
                $return = $this->unFrozen($amount);
                break;
            default:
                if ($typeConfig['in_out'] === 1) {
                    $return = $this->doAdd($amount);
                } else {
                    $return = $this->cost($amount);
                }
        }
        return $return;
    }

    /**
     * 资金增加
     * @param float $money 金额.
     * @return boolean
     */
    public function doAdd(float $money): bool
    {
        $this->account->fresh();
        $this->account->balance += $money;
        if ($this->account->save()) {
            $return = true;
        } else {
            $return = false;
        }
        return $return;
    }

    /**
     * 消耗资金
     * @param float $money 金额.
     * @return mixed
     */
    public function cost(float $money)
    {
        $this->account->fresh();
        if ($money > $this->account->balance) {
            return '对不起, 用户余额不足!';
        }
        $this->account->balance -= $money;
        if ($this->account->save()) {
            return true;
        }
    }

    /**
     * 冻结资金
     * @param float $money 金额.
     * @return mixed
     */
    public function frozen(float $money)
    {
        $this->account->fresh();
        if ($money > $this->account->balance) {
            return '对不起, 用户余额不足!';
        }
        $this->account->balance -= $money;
        $this->account->frozen  += $money;
        if ($this->account->save()) {
            $return = true;
        } else {
            $return = false;
        }
        return $return;
    }

    /**
     * 解冻
     * @param float $money 金额.
     * @return boolean
     */
    public function unFrozen(float $money): bool
    {
        $this->account->balance += $money;
        $this->account->frozen  -= $money;
        $save                    = $this->account->save();
        return $save;
    }

    /**
     *
     * @param  array        $params          参数.
     * @param  array        $typeConfig      帐变类型.
     * @param  FrontendUser $user            用户Eloq.
     * @param  float        $beforeBalance   帐变前金额.
     * @param  float        $beforeFrozen    帐变前冻结金额.
     * @param  array        $reportFieldData 帐变参数详情.
     * @return boolean
     */
    private function _saveData(
        array $params,
        array $typeConfig,
        FrontendUser $user,
        float $beforeBalance,
        float $beforeFrozen,
        array $reportFieldData
    ): bool {
        // 保存帐变记录
        $report         = [
            'serial_number'         => self::getSerialNumber(),
            'activity_sign'         => $params['activity_sign'] ?? 0,
            'desc'                  => $params['desc'] ?? 0,
            'frozen_type'           => $typeConfig['frozen_type'],
            'process_time'          => time(),
            'platform_sign'         => $user->platform_sign,
            'top_id'                => $user->top_id,
            'type_name'             => $typeConfig['name'],
            'type_sign'             => $typeConfig['sign'],
            'in_out'                => $typeConfig['in_out'],
            'username'              => $user->username,
            'before_balance'        => $beforeBalance,
            'balance'               => $this->account->balance,
            'frozen_balance'        => $this->account->frozen,
            'before_frozen_balance' => $beforeFrozen,
        ];
        $accountsReport = new FrontendUsersAccountsReport();
        $accountsReport->fill($report);
        if (!$accountsReport->save()) {
            return false;
        }
        //插入帐变详情数据
        $reportFieldData['parent_id'] = $user->parent_id;
        $reportFieldEloq              = new FrontendUsersAccountsReportsParamsWithValue();
        $reportFieldEloq->fill($reportFieldData);
        $save = $reportFieldEloq->save();
        return $save;
    }

    /**
     * 生成帐变编号
     * @return string
     */
    public static function getSerialNumber(): string
    {
        $serialNumber = 'JHHY' . Str::orderedUuid()->getNodeHex();
        return $serialNumber;
    }
}
