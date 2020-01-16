<?php

namespace App\Http\SingleActions\Backend\Merchant\Game;

use App\Models\Game\GamesType;
use App\Models\Game\GamesVendor;
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
        $gameVendors = GamesVendor::select(['id', 'name', 'sign'])
            ->withCacheCooldownSeconds(86400)
            ->get();
        $gameTypes   = GamesType::select(['id', 'name', 'sign'])
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
