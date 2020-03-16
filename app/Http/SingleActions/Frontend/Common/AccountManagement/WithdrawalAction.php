<?php

namespace App\Http\SingleActions\Frontend\Common\AccountManagement;

use App\Http\Requests\Frontend\Common\FrontendUser\WithdrawalRequest;
use App\Http\SingleActions\MainAction;
use App\Models\Order\UsersRechargeOrder;
use App\Models\User\UsersWithdrawOrder;
use Arr;
use DB;
use Illuminate\Http\JsonResponse;
use Log;
use RuntimeException;

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
     * @throws \Exception Exception.
     * @throws \RuntimeException Exception.
     */
    public function execute(WithdrawalRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $user      = $this->user;
        $balance   = $user->account()->get('balance')->first()->balance;
        if ($validated['amount'] > $balance) {
            throw new \RuntimeException('100906');
        }
        $num_withdrawal   = UsersWithdrawOrder::select('id')->where('user_id', $user->id)
            ->whereDate('created_at', date('Y-m-d'))->count();
        $day_withdraw_num = configure($this->user->platform_sign, 'day_withdraw_num');// 每日可提现次数
        if ($num_withdrawal === (int) $day_withdraw_num) {
            throw new RuntimeException('100904');
        }
        $total_withdrawal = UsersWithdrawOrder::where('user_id', $user->id)
            ->whereBetween('created_at', [date('Y-m-01'), date('Y-m-t')])->sum('amount');
        $num_top_up       = UsersRechargeOrder::select('id')
            ->where('status', UsersRechargeOrder::STATUS_SUCCESS)->count();
        $account_snapshot = $user->bankCard()->where('id', $validated['bank_id'])->first();
        $item             = $this->_orderItem(
            $validated['amount'],
            $account_snapshot->type,
            $user->mobile,
            $balance,
            Arr::only($account_snapshot->toArray(), ['owner_name', 'card_number', 'branch']),
            (float) $total_withdrawal + $balance,
            $num_withdrawal,
            $num_top_up,
        );
        DB::beginTransaction();
        try {
            $user->withdraw()->create($item);
            $user->account->operateAccount(['amount' => $validated['amount']], 'withdraw_frozen');
            DB::commit();
            $result = msgOut([], '100903');
            return $result;
        } catch (\RuntimeException $exception) {
            $data    = [
                        'file'    => $exception->getFile(),
                        'line'    => $exception->getLine(),
                        'message' => $exception->getMessage(),
                       ];
            $logData = [
                        'msg'  => '发起提现失败!',
                        'data' => $data,
                       ];
            Log::channel('withdrawal-system')
                ->info(json_encode($logData, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT, 512));
        }
        DB::rollBack();
        throw new \RuntimeException('100905');
    }

    /**
     * @param integer              $amount           总金额.
     * @param integer              $account_type     账户类型.
     * @param string               $mobile           Mobile.
     * @param float                $balance          账户总额.
     * @param array<string,string> $account_snapshot 账户快照.
     * @param float                $month_total      当月总提现.
     * @param integer              $num_withdrawal   今日出款次数.
     * @param integer              $num_top_up       今日充值次数.
     * @return mixed[]
     */
    private function _orderItem(
        int $amount,
        int $account_type,
        string $mobile,
        float $balance,
        array $account_snapshot,
        float $month_total,
        int $num_withdrawal,
        int $num_top_up
    ): array {
        $item = [
                 'amount'         => $amount,
                 'account_type'   => $account_type,
                 'mobile'         => $mobile,
                 'before_balance' => $balance,
                 'account_snap'   => $account_snapshot,
                 'month_total'    => $month_total,
                 'num_withdrawal' => $num_withdrawal,
                 'num_top_up'     => $num_top_up,
                 'platform_sign'  => $this->currentPlatformEloq->sign,
                ];
        return $item;
    }
}
