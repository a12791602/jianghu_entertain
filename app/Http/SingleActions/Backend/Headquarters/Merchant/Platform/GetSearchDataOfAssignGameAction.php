<?php

namespace App\Http\SingleActions\Backend\Headquarters\Merchant\Platform;

use App\Models\Game\Game;
use App\Models\Game\GamesVendor;
use Illuminate\Http\JsonResponse;

/**
 * Class GetSearchDataOfAssignGameAction
 *
 * @package App\Http\SingleActions\Backend\Headquarters\Merchant\Platform
 */
class GetSearchDataOfAssignGameAction
{
    /**
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(): JsonResponse
    {
        $games   = Game::select(['id', 'type_id', 'vendor_id as ven_id', 'name'])->get();
        $vendors = GamesVendor::select(['id', 'name'])->get();
        $datas   = [
                    'games'   => $games,
                    'vendors' => $vendors,
                   ];
        $msgOut  = msgOut(true, $datas);
        return $msgOut;
    }
}
