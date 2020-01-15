<?php

namespace App\Http\SingleActions\Backend\Headquarters\Game;

use App\Models\Game\GamesType;
use App\Models\Game\GamesVendor;
use Illuminate\Http\JsonResponse;

/**
 * Class GetSearchConditionAction
 *
 * @package App\Http\SingleActions\Backend\Headquarters\Game
 */
class GetSearchConditionAction extends BaseAction
{
    /**
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(): JsonResponse
    {
        $games   = $this->model->select(['id', 'type_id', 'vendor_id', 'name'])->get();
        $vendors = GamesVendor::select(['id', 'name'])->get();
        $types   = GamesType::select(['id', 'name'])->get();
        $datas   = [
                    'games'   => $games,
                    'vendors' => $vendors,
                    'types'   => $types,
                   ];
        $msgOut  = msgOut(true, $datas);
        return $msgOut;
    }
}
