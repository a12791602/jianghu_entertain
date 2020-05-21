<?php

namespace App\Http\SingleActions\Backend\Headquarters\Statistic;

use App\Http\Resources\Backend\Headquarters\Statistic\IndexResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Redis;

/**
 * Class IndexAction
 * @package App\Http\SingleActions\Backend\Headquarters\Statistic
 */
class IndexAction
{
    /**
     * Headquarters Homepage Statistics.
     * @return JsonResponse
     */
    public function execute(): JsonResponse
    {
        $redis  = Redis::connection();
        $top_up = $redis->lrange('headquarters_statistics:top_up', 0, -1);
        $top_up = collect($top_up);
        $top_up->transform(
            static function ($item) {
                return json_decode($item, true);
            },
        );
        $top_up_amount = $top_up->sum('amount');
        $top_up_num    = $top_up->unique('user_id')->count();
        $withdrawal    = $redis->lrange('headquarters_statistics:withdrawal', 0, -1);
        $withdrawal    = collect($withdrawal);
        $withdrawal->transform(
            static function ($item) {
                return json_decode($item, true);
            },
        );
        $withdrawal_amount = $withdrawal->sum('amount');
        $withdrawal_num    = $withdrawal->unique('user_id')->count();

        $item = [
                 'withdrawal_num'    => $withdrawal_num,
                 'withdrawal_amount' => $withdrawal_amount,
                 'top_up_num'        => $top_up_num,
                 'top_up_amount'     => $top_up_amount,
                ];
        return msgOut(IndexResource::make($item));
    }
}
