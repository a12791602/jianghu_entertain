<?php

namespace App\Http\SingleActions\Frontend\Common\AccountManagement;

use App\Events\PlatformNoticeEvent;
use App\Http\Requests\Frontend\Common\FrontendUser\WithdrawalRequest;
use App\Http\SingleActions\MainAction;
use App\Models\Notification\MerchantNotificationStatistic;
use App\Models\Order\UsersRechargeOrder;
use App\Models\User\FrontendUser;
use App\Models\User\FrontendUsersAccount;
use App\Models\User\UsersWithdrawOrder;
use Arr;
use DB;
use Illuminate\Http\JsonResponse;
use Log;

/**
 * Class WithdrawalAction
 * @package App\Http\SingleActions\Frontend\Common\AccountManagement
 */
class WithdrawalAction extends MainAction
{
    /**
     * Account withdrawal.
     * @param WithdrawalRequest $request WithdrawalRequest.
     * @return JsonResponse
     * @throws \RuntimeException Exception.
     */
    public function execute(WithdrawalRequest $request): JsonResponse
    {
        $validated      = $request->validated();
        $user           = $this->user;
        $amount         = (float) $validated['amount'];
        $balance        = $this->_balance($amount);
        $num_withdrawal = UsersWithdrawOrder::select('id')->where('user_id', $user->id)
            ->whereDate('created_at', date('Y-m-d'))->count();
        $this->_dayWithdrawNum($num_withdrawal);
        $total_withdrawal = UsersWithdrawOrder::where('user_id', $user->id)
            ->whereBetween('created_at', [date('Y-m-01'), date('Y-m-t')])->sum('amount');
        $num_top_up       = UsersRechargeOrder::select('id')
            ->where('status', UsersRechargeOrder::STATUS_SUCCESS)->count();
        $account_snapshot = $user->bankCard()->where('id', $validated['bank_id'])->first();
        $audit_fee        = $this->_audit($this->user, $amount);
        $item             = $this->_orderItem(
            $amount,
            $account_snapshot->type,
            $user->mobile,
            $balance,
            Arr::only($account_snapshot->toArray(), ['owner_name', 'card_number', 'branch']),
            (float) $total_withdrawal + $balance,
            $num_withdrawal,
            $num_top_up,
            $audit_fee,
        );
        DB::beginTransaction();
        try {
            $order = $user->withdraw()->create($item);
            $param = [
                      'user_id' => $user->id,
                      'amount'  => $amount,
                     ];
            $user->account->operateAccount('withdraw_frozen', $param);
            DB::commit();
            broadcast(new PlatformNoticeEvent('notice_of_withdraw', '', $order->toArray()));
            merchantNotificationIncrement(MerchantNotificationStatistic::WITHDRAWAL_ORDER);
            return msgOut([], '100903');
        } catch (\RuntimeException $exception) {
            $logData = [
                        'msg'  => '发起提现失败!',
                        'data' => $exception,
                       ];
            Log::channel('withdrawal-system')
                ->info(json_encode($logData, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT, 512));
        }
        DB::rollBack();
        throw new \RuntimeException('100905');
    }

    /**
     * Check if the balance is enough to withdraw.
     * @param float $amount Withdrawal Amount.
     * @return float
     * @throws \RuntimeException RuntimeException.
     */
    private function _balance(float $amount): float
    {
        $balance = $this->user->account->balance;
        if ($amount > $balance) {
            throw new \RuntimeException('100906');
        }
        return $balance;
    }

    /**
     * Audit fee.
     * @param FrontendUser $user   FrontendUser.
     * @param float        $amount Withdrawal Amount.
     * @return float
     */
    private function _audit(FrontendUser $user, float $amount): float
    {
        $audit_fee = 0;
        if ((int) optional($user->account)->tax_status !== FrontendUsersAccount::TAX_STATUS_DONE) {
            $audit     = (float) configure($this->currentPlatformEloq->sign, 'audit_free');
            $audit_fee = $amount * $audit;
        }
        return (float) $audit_fee;
    }

    /**
     * 检查每日可提现次数.
     * @param integer $num_withdrawal Num_withdrawal.
     * @return integer
     * @throws \RuntimeException RuntimeException.
     */
    private function _dayWithdrawNum(int $num_withdrawal): int
    {
        $day_withdraw_num = (int) configure($this->user->platform_sign, 'day_withdraw_num');
        if ($num_withdrawal >= $day_withdraw_num) {
            throw new \RuntimeException('100904');
        }
        return (int) $day_withdraw_num;
    }

    /**
     * @param float                $amount           总金额.
     * @param integer              $account_type     账户类型.
     * @param string               $mobile           Mobile.
     * @param float                $balance          账户总额.
     * @param array<string,string> $account_snapshot 账户快照.
     * @param float                $month_total      当月总提现.
     * @param integer              $num_withdrawal   今日出款次数.
     * @param integer              $num_top_up       今日充值次数.
     * @param float                $audit_fee        今日充值次数.
     * @return mixed[]
     */
    private function _orderItem(
        float $amount,
        int $account_type,
        string $mobile,
        float $balance,
        array $account_snapshot,
        float $month_total,
        int $num_withdrawal,
        int $num_top_up,
        float $audit_fee
    ): array {
        return [
                'amount'         => $amount,
                'account_type'   => $account_type,
                'mobile'         => $mobile,
                'before_balance' => $balance,
                'account_snap'   => $account_snapshot,
                'month_total'    => $month_total,
                'num_withdrawal' => $num_withdrawal,
                'num_top_up'     => $num_top_up,
                'audit_fee'      => $audit_fee,
                'platform_sign'  => $this->currentPlatformEloq->sign,
               ];
    }
}
