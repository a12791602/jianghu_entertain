<?php

namespace App\Http\SingleActions\Frontend\H5\Recharge;

use App\Http\Controllers\FrontendApi\FrontendApiMainController;
use App\Models\Finance\SystemFinanceType;
use Illuminate\Http\JsonResponse;

/**
 * Class ChannelsAction
 * @package App\Http\SingleActions\Frontend\H5\Recharge
 */
class ChannelsAction
{
    /**
     * @param FrontendApiMainController $contll     Contll.
     * @param array                     $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(FrontendApiMainController $contll, array $inputDatas): JsonResponse
    {
        $inputDatas['tag_id']        = $contll->frontendUser->user_tag_id;
        $inputDatas['platform_sign'] = $contll->frontendUser->platform_sign;
        $inputDatas['platform_id']   = $contll->frontendUser->platform_id;
        $type                        = SystemFinanceType::find($inputDatas['type_id']);
        $data                        = [];
        if ($type->is_online === SystemFinanceType::IS_ONLINE_YES) {
            $data = $this->_getOnlineChannels($inputDatas);
        } elseif ($type->is_online === SystemFinanceType::IS_ONLINE_NO) {
            $data = $this->_getOfflineChannels($inputDatas);
        }
        $msgOut = msgOut(true, $data);
        return $msgOut;
    }

    /**
     * 获取线上支付方式
     * @param array $inputDatas InputDatas.
     * @return mixed[]
     */
    private function _getOnlineChannels(array $inputDatas): array
    {
        $data = SystemFinanceType::with(
            ['onlineInfos' => static function ($query) use ($inputDatas) {
                    $query = $query->where('platform_sign', $inputDatas['platform_sign'])
                        ->join(
                            'system_finance_user_tags',
                            'system_finance_online_infos.id',
                            '=',
                            'system_finance_user_tags.finance_id',
                        )->where('system_finance_user_tags.is_online', SystemFinanceType::IS_ONLINE_YES)
                        ->where('system_finance_user_tags.tag_id', $inputDatas['tag_id'])
                        ->select(
                            [
                                'system_finance_online_infos.id',
                                'frontend_name',
                                'frontend_remark',
                                'min',
                                'max',
                                'handle_fee',
                                'merchant_no',
                                'system_finance_online_infos.desc',
                            ],
                        );
                    return $query;
            },
            ],
        )->select(['id', 'name', 'sign', 'is_online'])
            ->where('id', $inputDatas['type_id'])
            ->get()->toArray();
        return $data;
    }

    /**
     * 获取线下支付方式
     * @param array $inputDatas InputDatas.
     * @return mixed[]
     */
    private function _getOfflineChannels(array $inputDatas): array
    {
        $data = SystemFinanceType::with(
            ['offlineInfos' => static function ($query) use ($inputDatas) {
                    $query = $query->with('bank:id,name,code')
                        ->where('system_finance_offline_infos.platform_id', $inputDatas['platform_id'])
                        ->join(
                            'system_finance_user_tags',
                            'system_finance_offline_infos.id',
                            '=',
                            'system_finance_user_tags.finance_id',
                        )->where('system_finance_user_tags.is_online', SystemFinanceType::IS_ONLINE_NO)
                        ->where('system_finance_user_tags.tag_id', $inputDatas['tag_id'])
                        ->select(
                            [
                                'system_finance_offline_infos.id',
                                'bank_id',
                                'type_id',
                                'name',
                                'remark',
                                'qrcode',
                                'account',
                                'username',
                                'min',
                                'max',
                                'branch',
                                'fee',
                            ],
                        );
                    return $query;
            },
            ],
        )->select(['id', 'name', 'sign', 'is_online'])
            ->where('id', $inputDatas['type_id'])
            ->get()->toArray();
        return $data;
    }
}
