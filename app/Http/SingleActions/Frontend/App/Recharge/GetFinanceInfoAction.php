<?php

namespace App\Http\SingleActions\Frontend\App\Recharge;

use App\Http\SingleActions\MainAction;
use App\Models\Finance\SystemFinanceOfflineInfo;
use App\Models\Finance\SystemFinanceOnlineInfo;
use App\Models\Finance\SystemFinanceType;
use Illuminate\Http\JsonResponse;

/**
 * Class GetFinanceInfoAction
 * @package App\Http\SingleActions\Frontend\App\Recharge
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
        $data                  = SystemFinanceType::with(
            [
             'onlineInfos'  => static function ($query) use ($data): object {
                 $query = self::getOnlineInfos($query, $data);
                 return $query;
             },
             'offlineInfos' => static function ($query) use ($data): object {
                 $query = self::getOfflineInfos($query, $data);
                 return $query;
             },
            ],
        )->filter($data)
         ->withCacheCooldownSeconds(86400)
         ->get(['id', 'name', 'sign', 'is_online']);
        return msgOut($data);
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
     * @param object $query     Query.
     * @param array  $inputData InputData.
     * @return object
     */
    protected static function getOfflineInfos(object $query, array $inputData): object
    {
        //搜索的条件
        $whereConditions = ['status' => SystemFinanceOfflineInfo::STATUS_YES];
        //返回的字段
        $returnField = [
                        'id',
                        'bank_id',
                        'type_id',
                        'name',
                        'remark',
                        'min_amount',
                        'max_amount',
                        'fee',
                       ];
        $query->with('bank:id,name,code')->whereHas(
            'tags',
            static function ($query) use ($inputData): object {
                $query = $query->where(
                    [
                     'id'        => $inputData['tag_id'],
                     'is_online' => SystemFinanceType::IS_ONLINE_NO,
                    ],
                );
                return $query;
            },
        )->where($whereConditions)->select($returnField);
        return $query;
    }
}
