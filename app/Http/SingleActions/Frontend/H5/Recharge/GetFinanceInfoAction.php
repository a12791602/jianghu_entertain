<?php

namespace App\Http\SingleActions\Frontend\H5\Recharge;

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
        $items                 = SystemFinanceType::filter($data)->get(['id', 'name', 'sign', 'is_online']);
        $result                = $items->map(
            static function ($item) {
                $offlineChannels = $item->offlineInfos->filter();
                $offline_item    = null;
                if ($offlineChannels->isNotEmpty()) {
                    $offline_info = $offlineChannels->random();
                    $offline_item = [
                                     'id'          => $offline_info->id,
                                     'account'     => $offline_info->account,
                                     'branch'      => $offline_info->branch,
                                     'username'    => $offline_info->username,
                                     'type_id'     => $offline_info->type_id,
                                     'min_amount'  => (float) sprintf('%.2f', $offline_info->min_amount),
                                     'max_amount'  => (float) sprintf('%.2f', $offline_info->max_amount),
                                     'service_fee' => (float) sprintf('%.2f', $offline_info->service_fee),
                                     'bank'        => $offline_info->bank()->select(['id', 'name', 'code'])->first(),
                                    ];
                }//end if
                return [
                        'id'               => $item->id,
                        'name'             => $item->name,
                        'sign'             => $item->sign,
                        'transfer_account' => $offline_item,
                       ];
            },
            );
        $fresult               = [
                                  'online_infos'  => [],
                                  'offline_infos' => $result,
                                 ];
        return msgOut($fresult);
    }
}
