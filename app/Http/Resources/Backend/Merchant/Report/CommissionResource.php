<?php

namespace App\Http\Resources\Backend\Merchant\Report;

use App;
use App\Http\Resources\BaseResource;
use App\Models\Game\Game;

/**
 * Class CommissionResource
 * @package App\Http\Resources\Backend\Merchant\Game
 */
class CommissionResource extends BaseResource
{

    /**
     * @var \Carbon\Carbon $rDay Day.
     */
    private $rDay;

    /**
     * @var string $mobile 会员账号.
     */
    private $mobile;

    /**
     * @var string $guid 会员ID.
     */
    private $guid;

    /**
     * @var string $game_vendor_sign 游戏厂商标识.
     */
    private $game_vendor_sign;

    /**
     * @var \App\Models\Game\GameVendor $gameVendor 游戏厂商.
     */
    private $gameVendor;

    /**
     * @var float $effective_bet 有效下注.
     */
    private $effective_bet;

    /**
     * @var float $bet_money 下注金额.
     */
    private $bet_money;

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
                'mobile'           => $this->mobile,
                'guid'             => $this->guid,
                'game_vendor_sign' => $this->game_vendor_sign,
                'game_vendor_name' => $this->gameVendor->name ?? '',
                'bet_money'        => $this->bet_money,
                'effective_bet'    => $this->effective_bet,
                'rebate'           => $this->rebate,
               ];
    }
}
