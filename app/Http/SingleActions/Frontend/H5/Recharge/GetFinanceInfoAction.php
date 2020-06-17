<?php

namespace App\Http\SingleActions\Frontend\H5\Recharge;

use App\Http\Resources\Frontend\Common\TopUp\OfflineInfoResource;
use App\Http\Resources\Frontend\Common\TopUp\OnlineInfoResource;
use App\Http\SingleActions\MainAction;
use App\Models\Finance\SystemFinanceType;
use App\Models\User\FrontendUser;
use Illuminate\Http\JsonResponse;

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
        if (!$this->user instanceof FrontendUser) {
            throw new \Exception('100505');//用户不存在
        }
        $data                  = [];
        $data['tag_id']        = $this->user->user_tag_id;
        $data['platform_sign'] = $this->user->platform_sign;
        $data['status']        = SystemFinanceType::STATUS_YES;
        $data['direction']     = SystemFinanceType::DIRECTION_IN;
        $fresult               = [
                                  'online_infos'  => $this->_onlineInfo($data),
                                  'offline_infos' => $this->_offlineInfos($data),
                                 ];
        return msgOut($fresult);
    }

    /**
     * Get OffilneInfos.
     * @param array $data Data.
     * @return mixed
     */
    private function _offlineInfos(array $data)
    {
        $data['is_online'] = SystemFinanceType::IS_ONLINE_NO;
        $items             = SystemFinanceType::filter($data)->get(['id', 'name', 'sign']);
        return OfflineInfoResource::collection($items);
    }

    /**
     * Get OnlineInfos.
     * @param array $data Data.
     * @return mixed
     */
    private function _onlineInfo(array $data)
    {
        $data['is_online'] = SystemFinanceType::IS_ONLINE_YES;
        $items             = SystemFinanceType::filter($data)->get(['id', 'name', 'sign']);
        return OnlineInfoResource::collection($items);
    }
}
