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
        $gameVendors = GameVendor::select(['id', 'name', 'sign'])
            ->withCacheCooldownSeconds(86400)
            ->get();
        $gameTypes   = GameType::select(['id', 'name', 'sign'])
            ->withCacheCooldownSeconds(86400)
            ->get();
        $datas       = [
                        'gameVendors' => $gameVendors,
                        'gameTypes'   => $gameTypes,
                       ];
        $result      = msgOut($datas);
        return $result;
    }
}
