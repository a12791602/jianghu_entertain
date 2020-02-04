<?php

namespace App\Http\SingleActions\Frontend\App\Recharge;

use App\Http\SingleActions\MainAction;
use App\Models\Finance\SystemFinanceOfflineInfo;
use App\Models\Finance\SystemFinanceOnlineInfo;
use App\Models\Finance\SystemFinanceType;
use Illuminate\Http\JsonResponse;

/**
 * Class ChannelsAction
 * @package App\Http\SingleActions\Frontend\App\Recharge
 */
class ChannelsAction extends MainAction
{
    /**
     * @param array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $inputDatas['tag_id']        = $this->user->user_tag_id;
        $inputDatas['platform_sign'] = $this->user->platform_sign;
        $inputDatas['platform_id']   = $this->user->platform_id;
        $type                        = SystemFinanceType::find($inputDatas['type_id']);
        $data                        = [];
        if ($type->is_online === SystemFinanceType::IS_ONLINE_YES) {
            $data = $this->_getOnlineChannels($inputDatas);
        } elseif ($type->is_online === SystemFinanceType::IS_ONLINE_NO) {
            $data = $this->_getOfflineChannels($inputDatas);
        }
        $msgOut = msgOut($data);
        return $msgOut;
    }

    /**
     * 获取线上支付方式
     * @param array $inputDatas InputDatas.
     * @return mixed[]
     */
    private function _getOnlineChannels(array $inputDatas): array
    {
        //搜索的条件
        $whereConditions = [
                            'platform_sign' => $inputDatas['platform_sign'],
                            'status'        => SystemFinanceOnlineInfo::STATUS_YES,
                           ];
        //返回的字段
        $returnField = [
                        'id',
                        'frontend_name',
                        'frontend_remark',
                        'min',
                        'max',
                        'handle_fee',
                        'merchant_no',
                        'desc',
                       ];
        // select id,frontend_name,frontend_remark,min,max,handle_fee,merchant_no,`desc`
        // from system_finance_online_infos
        // where exists (
        //                select *
        //                from system_finance_user_tags
        //                where tag_id=4 and is_online=1 and finance_id=1
        //              )
        //  and channel_id in (select id from system_finance_channels where type_id=5);
        $data = SystemFinanceOnlineInfo::whereHas(
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
        )->whereHas(
            'type',
            static function ($query) use ($inputDatas): object {
                $query = $query->where(['system_finance_types.id' => $inputDatas['type_id']]);
                return $query;
            },
        )->where($whereConditions)->get($returnField)->toArray();
        return $data;
    }

    /**
     * 获取线下支付方式
     * @param array $inputDatas InputDatas.
     * @return mixed[]
     */
    private function _getOfflineChannels(array $inputDatas): array
    {
        //搜索的条件
        $whereConditions = [
                            'type_id' => $inputDatas['type_id'],
                            'status'  => SystemFinanceOfflineInfo::STATUS_YES,
                           ];
        //返回的字段
        $returnField = [
                        'id',
                        'bank_id',
                        'type_id',
                        'name',
                        'remark',
                        'min',
                        'max',
                        'fee',
                       ];
        // select id,bank_id,type_id,`name`,remark,min,max,fee,system_banks.id,system_banks.`name`,system_banks.`code`
        // from system_finance_offline_infos
        // left join system_banks on system_finance_offline_infos.bank_id = system_banks.id where type_id=1
        // and exists (select * from system_finance_user_tags where tag_id=4 and is_online=1 and finance_id=1)
        $data = SystemFinanceOfflineInfo::with('bank:id,name,code')->whereHas(
            'tags',
            static function ($query) use ($inputDatas): object {
                $query = $query->where(
                    [
                     'tag_id'    => $inputDatas['tag_id'],
                     'is_online' => SystemFinanceType::IS_ONLINE_NO,
                    ],
                );
                return $query;
            },
        )->where($whereConditions)->get($returnField)->toArray();
        return $data;
    }
}
