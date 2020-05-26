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
                'profit_amount'                       => 0,
                'profit_percent'                      => 0 . '%',
                'top_up_amount'                       => $this->resource['top_up_amount'],
                'top_up_people'                       => $this->resource['top_up_num'],
                'withdrawal_amount'                   => $this->resource['withdrawal_amount'],
                'withdrawal_people'                   => $this->resource['withdrawal_num'],
                'gifts_amount'                        => 0,
                'gifts_people'                        => 0,
                'online_statistics_apk_percent'       => $device_apk_online / $total_user * 100 . '%',
                'online_statistics_apk_people'        => $device_apk_online,
                'online_statistics_app_percent'       => $device_app_online / $total_user * 100 . '%',
                'online_statistics_app_people'        => $device_app_online,
                'online_statistics_h5_percent'        => $device_h5_online / $total_user * 100 . '%',
                'online_statistics_h5_people'         => $device_h5_online,
                'online_statistics_pc_percent'        => $device_pc_online / $total_user * 100 . '%',
                'online_statistics_pc_people'         => $device_pc_online,
                'registration_statistics_apk_percent' => $device_apk_registration / $total_user * 100 . '%',
                'registration_statistics_apk_people'  => $device_apk_registration,
                'registration_statistics_app_percent' => $device_app_registration / $total_user * 100 . '%',
                'registration_statistics_app_people'  => $device_app_registration,
                'registration_statistics_h5_percent'  => $device_h5_registration / $total_user * 100 . '%',
                'registration_statistics_h5_people'   => $device_h5_registration,
                'registration_statistics_pc_percent'  => $device_pc_registration / $total_user * 100 . '%',
                'registration_statistics_pc_people'   => $device_pc_registration,

               ];
    }
}
