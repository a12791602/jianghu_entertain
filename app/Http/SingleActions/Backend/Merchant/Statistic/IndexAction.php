<?php

namespace App\Http\SingleActions\Backend\Merchant\Statistic;

use App\Http\Resources\Backend\Headquarters\Statistic\IndexResource;
use App\Http\SingleActions\MainAction;
use App\Lib\Constant\JHHYCnst;
use App\Models\User\FrontendUser;
use App\Models\User\UsersReportDay;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Redis;

/**
 * Class IndexAction
 * @package App\Http\SingleActions\Backend\Headquarters\Statistic
 */
class IndexAction extends MainAction
{

    /**
     * Merchant homepage statistics.
     * @return JsonResponse
     */
    public function execute(): JsonResponse
    {
        $platform      = $this->currentPlatformEloq->sign;
        $top_up_key    = 'merchant_statistics_' . $platform . ':top_up';
        $top_up        = $this->getCacheItem($top_up_key);
        $top_up_amount = $top_up->sum('amount');
        $top_up_num    = $top_up->unique('user_id')->count();

        $withdrawal_key    = 'merchant_statistics_' . $platform . ':withdrawal';
        $withdrawal        = $this->getCacheItem($withdrawal_key);
        $withdrawal_amount = $withdrawal->sum('amount');
        $withdrawal_num    = $withdrawal->unique('user_id')->count();

        $weekly_gift_key    = 'merchant_statistics_' . $platform . ':weekly_gift';
        $weekly_gift        = $this->getCacheItem($weekly_gift_key);
        $weekly_gift_amount = $weekly_gift->sum('amount');
        $weekly_gift_num    = $weekly_gift->unique('user_id')->count();
        $gift_num           = $weekly_gift_num;
        $gift_amount        = $weekly_gift_amount;

        $registration = [
                         'device_pc'  => FrontendUser::where('device_code', JHHYCnst::DEVICE_PC)->count(),
                         'device_h5'  => FrontendUser::where('device_code', JHHYCnst::DEVICE_H5)->count(),
                         'device_app' => FrontendUser::where('device_code', JHHYCnst::DEVICE_APP)->count(),
                         'device_apk' => FrontendUser::where('device_code', JHHYCnst::DEVICE_APK)->count(),
                        ];
        $online       = $this->online();

        $item = [
                 'online'                => $online,
                 'registration'          => $registration,
                 'withdrawal_num'        => $withdrawal_num,
                 'withdrawal_amount'     => $withdrawal_amount,
                 'top_up_num'            => $top_up_num,
                 'top_up_amount'         => $top_up_amount,
                 'gift_num'              => $gift_num,
                 'gift_amount'           => $gift_amount,
                 'top_up_and_withdrawal' => $this->statement(),
                ];
        return msgOut(IndexResource::make($item));
    }

    /**
     * Array conversion
     * @param string $cache_key Cache_key.
     * @return Collection
     */
    public function getCacheItem(string $cache_key): Collection
    {
        $redis    = Redis::connection();
        $get_item = $redis->lrange($cache_key, 0, -1);
        $item     = collect($get_item);
        $item->transform(
            static function ($item) {
                return json_decode($item, true);
            },
        );
        return $item;
    }

    /**
     * online user statistics
     * @return array<string,int>
     */
    public function online(): array
    {
        return [
                'device_pc'  => FrontendUser::where(
                    [
                     'is_online'   => JHHYCnst::ONLINE,
                     'device_code' => JHHYCnst::DEVICE_PC,
                    ],
                )->count(),
                'device_h5'  => FrontendUser::where(
                    [
                     'is_online'   => JHHYCnst::ONLINE,
                     'device_code' => JHHYCnst::DEVICE_H5,
                    ],
                )->count(),
                'device_app' => FrontendUser::where(
                    [
                     'is_online'   => JHHYCnst::ONLINE,
                     'device_code' => JHHYCnst::DEVICE_APP,
                    ],
                )->count(),
                'device_apk' => FrontendUser::where(
                    [
                     'is_online'   => JHHYCnst::ONLINE,
                     'device_code' => JHHYCnst::DEVICE_APK,
                    ],
                )->count(),
               ];
    }

    /**
     * Account finance statement.
     * @return array<string,float>
     */
    public function statement(): array
    {
        return [
                'before_yesterday_top_up'   => $this->query(Carbon::parse('2 day ago')->toDateString(), 'recharge_sum'),
                'yesterday_top_up'          => $this->query(Carbon::yesterday()->toDateString(), 'recharge_sum'),
                'today_top_up'              => $this->query(Carbon::today()->toDateString(), 'recharge_sum'),
                'before_yesterday_withdraw' => $this->query(Carbon::parse('2 day ago')->toDateString(), 'withdraw_sum'),
                'yesterday_withdraw'        => $this->query(Carbon::yesterday()->toDateString(), 'withdraw_sum'),
                'today_withdraw'            => $this->query(Carbon::today()->toDateString(), 'withdraw_sum'),
               ];
    }

    /**
     * Query.
     * @param string $date      Date.
     * @param string $field_sum Field_sum.
     * @return float
     */
    public function query(string $date, string $field_sum): float
    {
        return UsersReportDay::select(
                [
                 'recharge_sum',
                 'withdraw_sum',
                 'day',
                ],
            )
        ->filter(['report_day' => [$date]])
        ->sum($field_sum);
    }
}
