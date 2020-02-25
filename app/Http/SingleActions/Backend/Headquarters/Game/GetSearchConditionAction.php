<?php

namespace App\Http\SingleActions\Backend\Headquarters\Game;

use App\Models\Game\GameType;
use App\Models\Game\GameVendor;
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
        $vendors = GameVendor::select(['id', 'name'])->get();
        $types   = GameType::select(['id', 'name'])->get();
        $datas   = [
                    'games'   => $games,
                    'vendors' => $vendors,
                    'types'   => $types,
                   ];
        $msgOut  = msgOut($datas);
        return $msgOut;
    }
}
