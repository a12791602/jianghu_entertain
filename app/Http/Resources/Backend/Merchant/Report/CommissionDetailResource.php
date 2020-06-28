<?php

namespace App\Http\Resources\Backend\Merchant\Report;

use App;
use App\Http\Resources\BaseResource;
use App\Models\Game\Game;

/**
 * Class CommissionDetailResource
 * @package App\Http\Resources\Backend\Merchant\Game
 */
class CommissionDetailResource extends BaseResource
{

    /**
     * @var \Carbon\Carbon $rDay Day.
     */
    private $rDay;

    /**
     * @var \App\Models\Game\Game $gameVendor 游戏.
     */
    private $game;

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
                'day'           => $this->rDay,
                'game_name'     => $this->game->name ?? '',
                'bet_money'     => $this->bet_money,
                'effective_bet' => $this->effective_bet,
                'rebate'        => $this->rebate,
               ];
    }
}
