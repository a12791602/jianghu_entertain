<?php

namespace App\Models\User\Logics;

use App\Lib\Locker\AccountLocker;
use App\Models\User\FrontendUser;
use App\Models\User\FrontendUsersAccountsReport;
use App\Models\User\FrontendUsersAccountsType;
use App\Models\User\FrontendUsersAudit;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

trait UserAccountLogics
{

    /**
     * @param  string $type   帐变类型.
     * @param  array  $params 扩展数据.
     * @throws \Exception Exception.
     * @return mixed
     */
    public function operateAccount(string $type, array $params = [])
    {
        $accountLocker = new AccountLocker($this->frontendUser->id);
        if (!$accountLocker->getLock()) {
            throw new \Exception('100200');
        }
        // 帐变
        DB::beginTransaction();
        $resource = $this->doChange($type, $params);
        $accountLocker->release();
        if ($resource !== true) {
            DB::rollback();
            throw new \Exception('100204');
        }
        DB::commit();
        return true;
    }

    /**
     * @param string $typeSign 帐变类型.
     * @param array  $params   参数.
     * @throws \Exception Exception.
     * @return mixed
     */
    public function doChange(string $typeSign, array $params)
    {
        $user = $this->frontendUser;
        if (!$user) {
            throw new \Exception('100206');
        }
        $typeConfig = FrontendUsersAccountsType::getTypeBySign($typeSign);
        //　1. 获取帐变配置
        $paramsValidator = FrontendUsersAccountsType::getParamToTransmit($typeSign);
        // 2. 参数检测
        $validator = Validator::make($params, $paramsValidator);
        if ($validator->fails()) {
            DB::rollback();
            throw new \Exception('100201');
        }
        // 3. 检测金额
        $amount = abs($params['amount']);
        if ((bool) $amount === false) {
            return true;
        }
        // 冻结类型 1 冻结自己金额 2 冻结退还
        // 资金增减. 需要检测对应
        $beforeBalance = $this->balance;
        $beforeFrozen  = $this->frozen;
        $amount        = (float) $amount;
        // 根据冻结类型处理
        $return = $this->_handleFrozen($typeConfig, $amount);
        if ($return !== true) {
            DB::rollback();
            throw new \Exception('100202');
        }
        // 修改数据
        $saveData = $this->_saveData(
            $params,
            $typeConfig,
            $user,
            $beforeBalance,
            $beforeFrozen,
            $amount,
        );
        //稽核处理
        $this->_auditHandle($user, $typeConfig, $amount);
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
                $result = $this->frozen($amount);
                break;
            case self::FROZEN_STATUS_BACK:
                $result = $this->unFrozen($amount);
                break;
            case self::FROZEN_STATUS_GAME_WIN:
                break;
            case self::FROZEN_STATUS_TO_SYSTEM:
                $result = $this->costFrozen($amount);
                break;
            case self::FROZEN_STATUS_NO:
                if ($typeConfig['in_out'] === 1) {
                    $result = $this->doAdd($amount);
                } else {
                    $result = $this->cost($amount);
                }
                break;
            default:
                $result = false;
        }
        return $result;
    }

    /**
     * 资金增加
     * @param float $money 金额.
     * @return boolean
     */
    public function doAdd(float $money): bool
    {
        $this->fresh();
        $this->balance += $money;
        return $this->save();
    }

    /**
     * 消耗资金
     * @param float $money 金额.
     * @throws \Exception Exception.
     * @return boolean
     */
    public function cost(float $money): bool
    {
        $this->fresh();
        if ($money > $this->balance) {
            DB::rollback();
            throw new \Exception('100203');
        }
        $this->balance -= $money;
        return $this->save();
    }

    /**
     * 冻结资金
     * @param float $money 金额.
     * @throws \Exception Exception.
     * @return boolean
     */
    public function frozen(float $money): bool
    {
        $this->fresh();
        if ($money > $this->balance) {
            DB::rollback();
            throw new \Exception('100203');
        }
        $this->balance -= $money;
        $this->frozen  += $money;
        return $this->save();
    }

    /**
     * 解冻
     * @param float $money 金额.
     * @return boolean
     */
    public function unFrozen(float $money): bool
    {
        $this->balance += $money;
        $this->frozen  -= $money;
        return $this->save();
    }

    /**
     * 消耗冻结资金
     * @param float $money 金额.
     * @throws \Exception Exception.
     * @return boolean
     */
    public function costFrozen(float $money): bool
    {
        if ($money > $this->frozen) {
            DB::rollback();
            throw new \Exception('100205');
        }
        $this->frozen -= $money;
        return $this->save();
    }

    /**
     *
     * @param  array        $params        参数.
     * @param  array        $typeConfig    帐变类型.
     * @param  FrontendUser $user          用户Eloq.
     * @param  float        $beforeBalance 帐变前金额.
     * @param  float        $beforeFrozen  帐变前冻结金额.
     * @param  float        $amount        金额.
     * @return boolean
     */
    private function _saveData(
        array $params,
        array $typeConfig,
        FrontendUser $user,
        float $beforeBalance,
        float $beforeFrozen,
        float $amount
    ): bool {
        // 保存帐变记录
        $report = [
                   'user_id'               => $user->id,
                   'parent_id'             => $user->parent_id,
                   'serial_number'         => getSerialNumber(),
                   'activity_sign'         => $params['activity_sign'] ?? 0,
                   'desc'                  => $params['desc'] ?? 0,
                   'frozen_type'           => $typeConfig['frozen_type'],
                   'process_time'          => time(),
                   'platform_sign'         => $user->platform_sign,
                   'top_id'                => $user->top_id,
                   'type_name'             => $typeConfig['name'],
                   'type_sign'             => $typeConfig['sign'],
                   'in_out'                => $typeConfig['in_out'],
                   'username'              => $user->specificInfo->nickname ?? null,
                   'before_balance'        => $beforeBalance,
                   'balance'               => $this->balance,
                   'frozen_balance'        => $this->frozen,
                   'before_frozen_balance' => $beforeFrozen,
                   'params'                => json_encode($params),
                   'amount'                => $amount,
                  ];

        $accountsReport = new FrontendUsersAccountsReport();
        $accountsReport->fill($report);
        return $accountsReport->save();
    }

    /**
     * 稽核处理
     * @param  FrontendUser $user   用户Eloq.
     * @param  array        $type   账变类型Arr.
     * @param  float        $amount 金额.
     * @return void
     */
    private function _auditHandle(FrontendUser $user, array $type, float $amount): void
    {
        $sign      = getCurrentPlatformSign();
        $userAudit = new FrontendUsersAudit();
        if (in_array($type['sign'], $this->rechargeTypes)) {
            $demandBet = $this->_getDemandBet($sign, $amount, 'recharge_audit_times');
            $userAudit->createAudit($user, $type, $amount, $demandBet);
        } elseif (in_array($type['sign'], $this->activityTypes)) {
            $demandBet = $this->_getDemandBet($sign, $amount, 'activity_audit_times');
            $userAudit->createAudit($user, $type, $amount, $demandBet);
        }
    }

    /**
     * @param  string $platformSign 平台标识.
     * @param  float  $amount       金额.
     * @param  string $configSign   系统配置标识.
     * @return float
     */
    private function _getDemandBet(string $platformSign, float $amount, string $configSign): float
    {
        $auditTimes = configure($platformSign, $configSign);
        return $amount * $auditTimes;
    }
}
