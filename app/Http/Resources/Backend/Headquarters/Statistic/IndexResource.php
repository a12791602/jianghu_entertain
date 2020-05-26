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
        $total_user              = FrontendUser::count();
        $device_apk_online       = $this->resource['online']['device_apk'];
        $device_app_online       = $this->resource['online']['device_app'];
        $device_h5_online        = $this->resource['online']['device_h5'];
        $device_pc_online        = $this->resource['online']['device_pc'];
        $device_apk_registration = $this->resource['registration']['device_apk'];
        $device_app_registration = $this->resource['registration']['device_app'];
        $device_h5_registration  = $this->resource['registration']['device_h5'];
        $device_pc_registration  = $this->resource['registration']['device_pc'];
        return [
                'profit_amount'         => 0,
                'profit_percent'        => 0 . '%',
                'top_up_amount'         => (float) sprintf('%.2f', $this->resource['top_up_amount']),
                'top_up_people'         => $this->resource['top_up_num'],
                'withdrawal_amount'     => (float) sprintf('%.2f', $this->resource['withdrawal_amount']),
                'withdrawal_people'     => $this->resource['withdrawal_num'],
                'gifts_amount'          => (float) sprintf('%.2f', $this->resource['gift_amount']),
                'gifts_people'          => $this->resource['gift_num'],
                'online_apk_percent'    => (float) sprintf('%.2f', $device_apk_online / $total_user * 100) . '%',
                'online_apk_people'     => $device_apk_online,
                'online_app_percent'    => (float) sprintf('%.2f', $device_app_online / $total_user * 100) . '%',
                'online_app_people'     => $device_app_online,
                'online_h5_percent'     => (float) sprintf('%.2f', $device_h5_online / $total_user * 100) . '%',
                'online_h5_people'      => $device_h5_online,
                'online_pc_percent'     => (float) sprintf('%.2f', $device_pc_online / $total_user * 100) . '%',
                'online_pc_people'      => $device_pc_online,
                'sign_up_apk_percent'   => (float) sprintf('%.2f', $device_apk_registration / $total_user * 100) . '%',
                'sign_up_apk_people'    => $device_apk_registration,
                'sign_up_app_percent'   => (float) sprintf('%.2f', $device_app_registration / $total_user * 100) . '%',
                'sign_up_app_people'    => $device_app_registration,
                'sign_up_h5_percent'    => (float) sprintf('%.2f', $device_h5_registration / $total_user * 100) . '%',
                'sign_up_h5_people'     => $device_h5_registration,
                'sign_up_pc_percent'    => (float) sprintf('%.2f', $device_pc_registration / $total_user * 100) . '%',
                'sign_up_pc_people'     => $device_pc_registration,
                'top_up_and_withdrawal' => $this->resource['top_up_and_withdrawal'],
               ];
    }
}
