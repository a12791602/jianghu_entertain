<?php

namespace App\Http\SingleActions\Backend\Merchant\Game;

use App\Models\Game\GameType;
use App\Models\Game\GameVendor;
use Illuminate\Http\JsonResponse;

/**
 * Class GetSearchConditionDataAction
 * @package App\Http\SingleActions\Backend\Merchant\Game
 */
class GetSearchConditionDataAction extends BaseAction
{
    /**
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(): JsonResponse
    {
        $gameVendors = GameVendor::withCacheCooldownSeconds(86400)->get(['id', 'name', 'sign']);
        $gameTypes   = GameType::withCacheCooldownSeconds(86400)->get(['id', 'name', 'sign']);
        $datas       = [
                        'gameVendors' => $gameVendors,
                        'gameTypes'   => $gameTypes,
                       ];
        return msgOut($datas);
    }
}
