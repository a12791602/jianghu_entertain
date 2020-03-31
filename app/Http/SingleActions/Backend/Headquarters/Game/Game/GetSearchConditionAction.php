<?php

namespace App\Http\SingleActions\Backend\Headquarters\Game\Game;

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
        $games   = $this->model->get(['id', 'type_id', 'vendor_id', 'name']);
        $vendors = GameVendor::get(['id', 'name']);
        $types   = GameType::get(['id', 'name']);
        $datas   = [
                    'games'   => $games,
                    'vendors' => $vendors,
                    'types'   => $types,
                   ];
        return msgOut($datas);
    }
}
