<?php

namespace App\Http\Resources\Backend\Headquarters\Report;

use App\Http\Resources\BaseResource;

/**
 * Class GameVendorResource
 * @package App\Http\Resources\Backend\Headquarters\Game
 */
class GameVendorResource extends BaseResource
{

    /**
     * @var \Carbon\Carbon $rDay Day.
     */
    private $rDay;

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
     * @var float $win_money 中奖金额.
     */
    private $win_money;

    /**
     * @var float $our_net_win 税收金额.
     */
    private $our_net_win;

    /**
     * @var float $commission 佣金.
     */
    private $commission;

    /**
     * @var float $rebate 返利.
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
                'bet'              => $this->bet_money,
                'win_money'        => $this->win_money,
                'tax'              => $this->our_net_win,
                'commission'       => $this->commission,
                'rebate'           => $this->rebate,
               ];
    }
}
