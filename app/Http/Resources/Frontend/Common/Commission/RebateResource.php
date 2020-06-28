<?php

namespace App\Http\Resources\Frontend\Common\Commission;

use App;
use App\Http\Resources\BaseResource;

/**
 * Class RebateResource
 * @package App\Http\Resources\Backend\Merchant\Game
 */
class RebateResource extends BaseResource
{

    /**
     * @var \Carbon\Carbon $rDay Day.
     */
    private $rDay;

    /**
     * @var \App\Models\Game\GameVendor $gameVendor 游戏.
     */
    private $gameVendor;

    /**
     * @var float $effective_bet 有效下注.
     */
    private $effective_bet;

    /**
     * @var float $rebate 洗码返利.
     */
    private $rebate;

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
                'day'              => $this->rDay,
                'game_vendor_name' => $this->gameVendor->name ?? '',
                'effective_bet'    => $this->effective_bet,
                'rebate'           => $this->rebate,
                'percent'          => $this->rebate / $this->effective_bet * 100 . '%', //洗码百分比
               ];
    }
}
