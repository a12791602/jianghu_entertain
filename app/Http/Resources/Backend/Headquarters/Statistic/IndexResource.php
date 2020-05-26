<?php

namespace App\Http\Resources\Backend\Headquarters\Statistic;

use App\Http\Resources\BaseResource;
use App\Models\User\FrontendUser;

/**
 * Class IndexResource
 * @package App\Http\Resources\Backend\Headquarters\Merchant\Statistic
 */
class IndexResource extends BaseResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request Request.
     * @return mixed[]
     */
    public function toArray($request): array
    {
        //TODO 今日盈利, 彩金优惠
        unset($request);
        $item             = $this->resource;
        $total_user       = FrontendUser::count();
        $apk_online       = $item['online']['device_apk'];
        $app_online       = $item['online']['device_app'];
        $h5_online        = $item['online']['device_h5'];
        $pc_online        = $item['online']['device_pc'];
        $apk_registration = $item['registration']['device_apk'];
        $app_registration = $item['registration']['device_app'];
        $h5_registration  = $item['registration']['device_h5'];
        $pc_registration  = $item['registration']['device_pc'];
        return [
                'profit_amount'            => 0,
                'profit_percent'           => 0 . '%',
                'top_up_amount'            => (float) sprintf('%.2f', $item['top_up_amount']),
                'top_up_people'            => $item['top_up_num'],
                'withdrawal_amount'        => (float) sprintf('%.2f', $item['withdrawal_amount']),
                'withdrawal_people'        => $item['withdrawal_num'],
                'gifts_amount'             => (float) sprintf('%.2f', $item['gift_amount']),
                'gifts_people'             => $item['gift_num'],
                'online_apk_percent'       => (float) sprintf('%.2f', $apk_online / $total_user * 100) . '%',
                'online_apk_people'        => $apk_online,
                'online_app_percent'       => (float) sprintf('%.2f', $app_online / $total_user * 100) . '%',
                'online_app_people'        => $app_online,
                'online_h5_percent'        => (float) sprintf('%.2f', $h5_online / $total_user * 100) . '%',
                'online_h5_people'         => $h5_online,
                'online_pc_percent'        => (float) sprintf('%.2f', $pc_online / $total_user * 100) . '%',
                'online_pc_people'         => $pc_online,
                'sign_up_apk_percent'      => (float) sprintf('%.2f', $apk_registration / $total_user * 100) . '%',
                'sign_up_apk_people'       => $apk_registration,
                'sign_up_app_percent'      => (float) sprintf('%.2f', $app_registration / $total_user * 100) . '%',
                'sign_up_app_people'       => $app_registration,
                'sign_up_h5_percent'       => (float) sprintf('%.2f', $h5_registration / $total_user * 100) . '%',
                'sign_up_h5_people'        => $h5_registration,
                'sign_up_pc_percent'       => (float) sprintf('%.2f', $pc_registration / $total_user * 100) . '%',
                'sign_up_pc_people'        => $pc_registration,
                'top_up_and_withdrawal'    => $item['top_up_and_withdrawal'],
                'platform_end_time'        => $item['platform_end_time'],
                'sign_up_today'            => $item['sign_up_today'],
                'sign_up_and_top_up_today' => $item['sign_up_and_top_up_today'],
               ];
    }
}
