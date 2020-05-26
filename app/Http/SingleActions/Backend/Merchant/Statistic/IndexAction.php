<?php

namespace App\Http\SingleActions\Backend\Merchant\Statistic;

use App\Http\Resources\Backend\Headquarters\Statistic\IndexResource;
use App\Http\SingleActions\MainAction;
use App\Lib\Constant\JHHYCnst;
use App\Models\User\FrontendUser;
use Illuminate\Http\JsonResponse;
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
        $platform = $this->currentPlatformEloq->sign;
        $redis    = Redis::connection();
        $top_up   = $redis->lrange('merchant_statistics_' . $platform . ':top_up', 0, -1);
        $top_up   = collect($top_up);
        $top_up->transform(
            static function ($item) {
                return json_decode($item, true);
            },
        );
        $top_up_amount = $top_up->sum('amount');
        $top_up_num    = $top_up->unique('user_id')->count();
        $withdrawal    = $redis->lrange('merchant_statistics_' . $platform . ':withdrawal', 0, -1);
        $withdrawal    = collect($withdrawal);
        $withdrawal->transform(
            static function ($item) {
                return json_decode($item, true);
            },
        );
        $withdrawal_amount = $withdrawal->sum('amount');
        $withdrawal_num    = $withdrawal->unique('user_id')->count();

        $registration = [
                         'device_pc'  => FrontendUser::where('device_code', JHHYCnst::DEVICE_PC)->count(),
                         'device_h5'  => FrontendUser::where('device_code', JHHYCnst::DEVICE_H5)->count(),
                         'device_app' => FrontendUser::where('device_code', JHHYCnst::DEVICE_APP)->count(),
                         'device_apk' => FrontendUser::where('device_code', JHHYCnst::DEVICE_APK)->count(),
                        ];
        $online       = $this->online();

        $item = [
                 'online'            => $online,
                 'registration'      => $registration,
                 'withdrawal_num'    => $withdrawal_num,
                 'withdrawal_amount' => $withdrawal_amount,
                 'top_up_num'        => $top_up_num,
                 'top_up_amount'     => $top_up_amount,
                ];
        return msgOut(IndexResource::make($item));
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
}
