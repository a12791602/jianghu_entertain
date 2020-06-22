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
        return [
                'total_logins'                  => [
                                                    [
                                                     'platform_name' => '江湖互娱',
                                                     'total'         => 2,
                                                    ],
                                                   ],
                'total_number_of_registrations' => [
                                                    [
                                                     'platform_name' => '江湖互娱',
                                                     'total'         => 3,
                                                    ],
                                                   ],
                'total_top_up'                  => [
                                                    [
                                                     'platform_name' => '江湖互娱',
                                                     'total_amount'  => $this->resource['top_up_amount'],
                                                     'total_people'  => $this->resource['top_up_num'],
                                                    ],
                                                   ],
                'total_withdrawal'              => [
                                                    [
                                                     'platform_name' => '江湖互娱',
                                                     'total_amount'  => $this->resource['withdrawal_amount'],
                                                     'total_people'  => $this->resource['withdrawal_num'],
                                                    ],
                                                   ],
               ];
    }
}
