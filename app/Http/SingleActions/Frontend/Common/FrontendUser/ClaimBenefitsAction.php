<?php

namespace App\Http\SingleActions\Frontend\Common\FrontendUser;

use App\Http\SingleActions\MainAction;
use App\Models\User\FrontendUserLevel;
use App\Models\User\FrontendUserLevelBenefit;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Redis;
use Log;

/**
 * Class ClaimBenefitsAction
 * @package App\Http\SingleActions\Frontend\Common\FrontendUser
 */
class ClaimBenefitsAction extends MainAction
{

    /**
     * 领取会员权益 [周礼金, 晋级礼金].
     * @param array $request Benefit types.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $request): JsonResponse
    {
        $type                 = $request['type'];
        $other_type           = json_decode($request['other_type'], true);
        $item                 = [];
        $condition            = [];
        $condition['level']   = $request['level'];
        $condition['user_id'] = $this->user->id;
        $user_level           = $this->user->specificInfo->level;
        if ($request['level'] > $user_level) {
            throw new \Exception('100805');
        }
        $gift_level = FrontendUserLevel::where('level', $request['level'])->first();
        if (!$gift_level instanceof FrontendUserLevel) {
            throw new \Exception('100804');
        }
        if ($type === 'weekly_gift') {
            $condition['promotion_gift'] = $other_type['promotion_gift'];
            $item[$type]                 = FrontendUserLevelBenefit::WEEKLY_GIFT_RECEIVED;
            if (FrontendUserLevelBenefit::where(array_merge($condition, $item))->exists()) {
                throw new \Exception('100805');
            }
            $param = [
                      'user_id' => $this->user->id,
                      'amount'  => $gift_level[$type],
                     ];
        } else {
            $condition['weekly_gift'] = $other_type['weekly_gift'];
            $item[$type]              = FrontendUserLevelBenefit::PROMOTION_GIFT_RECEIVED;
            if (FrontendUserLevelBenefit::where(array_merge($condition, $item))->exists()) {
                throw new \Exception('100805');
            }
            $param = [
                      'user_id' => $this->user->id,
                      'amount'  => $gift_level[$type],
                     ];
        }//end if
        $this->merchantCache($param, $type);
        try {
            FrontendUserLevelBenefit::where($condition)->update($item);
            $this->user->account->operateAccount('gift', $param);
            return msgOut([], '100800');
        } catch (\Throwable $exception) {
            Log::error($exception->getMessage());
        }
        throw new \Exception('100804');
    }

    /**
     * @param array  $param Amount.
     * @param string $type  Benefit type.
     * @return void
     */
    public function merchantCache(array $param, string $type): void
    {
        $gift_cache_item = json_encode(
            $param,
            JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT,
            512,
        );
        $time            = mktime(23, 59, 59) - mktime((int) date('H'), (int) date('i'), (int) date('s'));
        $redis           = Redis::connection();
        $gift_cache_key  = 'merchant_statistics_' . $this->user->platform_sign . ':' . $type;
        $redis->rpush($gift_cache_key, $gift_cache_item);
        $redis->expire($gift_cache_key, $time);
    }
}
