<?php

namespace App\Http\Resources\Backend\Headquarters\Report;

use App\Http\Resources\BaseResource;

/**
 * Class PlatformAccountResource
 * @package App\Http\Resources\Backend\Headquarters\Game
 */
class PlatformAccountResource extends BaseResource
{

    /**
     * @var \Carbon\Carbon $rDay Day.
     */
    private $rDay;

    /**
     * @var \App\Models\Systems\SystemPlatform $platform 平台.
     */
    private $platform;

    /**
     * @var float $recharge_sum 充值总额.
     */
    private $recharge_sum;

    /**
     * @var float $withdraw_sum 出款总额.
     */
    private $withdraw_sum;

    /**
     * @var float $reduced_sum 优惠总额.
     */
    private $reduced_sum;

    /**
     * @var float $activity_sum 活动总额.
     */
    private $activity_sum;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request Request.
     * @return mixed[]
     */
    public function toArray($request): array
    {
        unset($request);
        return [
                'day'           => $this->rDay,
                'platform_name' => $this->platform->cn_name ?? '',
                'recharge_sum'  => $this->recharge_sum,
                'withdraw_sum'  => $this->withdraw_sum,
                'reduced_sum'   => $this->reduced_sum,
                'activity_sum'  => $this->activity_sum,
               ];
    }
}
