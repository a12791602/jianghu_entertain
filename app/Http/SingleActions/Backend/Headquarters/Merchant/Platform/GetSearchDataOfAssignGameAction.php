<?php

namespace App\Http\SingleActions\Backend\Headquarters\Merchant\Platform;

use App\Http\SingleActions\MainAction;
use App\Models\Game\Game;
use App\Models\Game\GameVendor;
use Illuminate\Http\JsonResponse;

/**
 * Class GetSearchDataOfAssignGameAction
 *
 * @package App\Http\SingleActions\Backend\Headquarters\Merchant\Platform
 */
class GetSearchDataOfAssignGameAction extends MainAction
{
    /**
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(): JsonResponse
    {
        $games   = Game::get(['id', 'type_id', 'vendor_id as ven_id', 'name']);
        $vendors = GameVendor::get(['id', 'name']);
        $datas   = [
                    'games'   => $games,
                    'vendors' => $vendors,
                   ];
        $msgOut  = msgOut($datas);
        return $msgOut;
    }
}
