<?php

namespace App\Http\SingleActions\Frontend\H5\Recharge;

use App\Http\Resources\Frontend\Common\TopUp\GetFinanceInfoResource;
use App\Http\SingleActions\MainAction;
use App\Models\Finance\SystemFinanceOfflineInfo;
use App\Models\Finance\SystemFinanceOnlineInfo;
use App\Models\Finance\SystemFinanceType;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

/**
 * Class GetFinanceInfoAction
 * @package App\Http\SingleActions\Frontend\H5\Recharge
 */
class GetFinanceInfoAction extends MainAction
{
    /**
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(): JsonResponse
    {
        $data                  = [];
        $data['tag_id']        = $this->user->user_tag_id;
        $data['platform_sign'] = $this->user->platform_sign;
        $data['status']        = SystemFinanceType::STATUS_YES;
        $data['direction']     = SystemFinanceType::DIRECTION_IN;
        $item                  = SystemFinanceType::with(
            [
             'onlineInfos'  => static function ($query) use ($data): object {
                 $query = self::getOnlineInfos($query, $data);
                 return $query;
             },
             'offlineInfos' => static function ($query): object {
                 $query = self::getOfflineInfos($query);
                 return $query;
             },
            ],
        )->filter($data)->get(['id', 'name', 'sign', 'is_online']);
        $item->map(
            function ($item): void {
                if (!$item->offlineInfos instanceof Collection) {
                    return;
                }
                $item->offlineInfos->transform(
                    function ($item): ?SystemFinanceOfflineInfo {
                        if (in_array(optional($this->user->userTag)->id, $item->tags->tag_id)) {
                            return $item;
                        }
                        return null;
                    },
                );
            },
        );
        return msgOut(GetFinanceInfoResource::collection($item));
    }

    /**
     * 获取线上支付信息.
     *
     * @param object $query      Query.
     * @param array  $inputDatas InputDatas.
     * @return object
     */
    protected static function getOnlineInfos(object $query, array $inputDatas): object
    {
        //搜索的条件
        $whereConditions = [
                            'platform_sign'                      => $inputDatas['platform_sign'],
                            'system_finance_online_infos.status' => SystemFinanceOnlineInfo::STATUS_YES,
                           ];
        //返回的字段
        $returnField = [
                        'system_finance_online_infos.id',
                        'frontend_name',
                        'frontend_remark',
                        'min_amount',
                        'max_amount',
                        'handle_fee',
                        'merchant_no',
                        'system_finance_online_infos.desc',
                       ];
        $query->whereHas(
            'tags',
            static function ($query) use ($inputDatas): object {
                $query = $query->where(
                    [
                     'tag_id'    => $inputDatas['tag_id'],
                     'is_online' => SystemFinanceType::IS_ONLINE_YES,
                    ],
                );
                return $query;
            },
        )->where($whereConditions)->select($returnField);
        return $query;
    }

    /**
     * 获取线下支付信息.
     *
     * @param object $query Query.
     * @return object
     */
    protected static function getOfflineInfos(object $query): object
    {
        //搜索的条件
        $whereConditions = ['status' => SystemFinanceOfflineInfo::STATUS_YES];
        //返回的字段
        $returnField = [
                        'id',
                        'bank_id',
                        'account',
                        'branch',
                        'username',
                        'type_id',
                        'name',
                        'remark',
                        'min_amount',
                        'max_amount',
                        'service_fee',
                       ];
        $query->with('bank:id,name,code')->whereHas(
            'tags',
            static function ($query): object {
                return $query->where(['is_online' => SystemFinanceType::IS_ONLINE_NO]);
            },
        )->where($whereConditions)->select($returnField)->orderByDesc('id');
        return $query;
    }
}
