<?php

namespace App\Http\SingleActions\Backend\Headquarters\Merchant\Platform;

use App\Http\Resources\Backend\Headquarters\Merchant\Platform\AssignedGameResource;
use App\Http\SingleActions\MainAction;
use App\Models\Game\GamePlatform;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class AssignedGamesAction
 * @package App\Http\SingleActions\Backend\Headquarters\Merchant\Platform
 */
class AssignedGamesAction extends MainAction
{
    /**
     * @param array $inputData InputData.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputData): JsonResponse
    {
        $condition                = [];
        $condition['status']      = GamePlatform::STATUS_OPEN;
        $condition['platform_id'] = $inputData['platform_id'];
        $item                     = GamePlatform::with('games')->where($condition)->get()->unique('game_id');
        $item_count               = $item->count();
        $page                     = $inputData['page'] ?? 1;
        $perPage                  = $inputData['pageSize'] ?? $item_count;
        $assigned_games           = new LengthAwarePaginator($item->forPage($page, $perPage), $item_count, $perPage);
        return msgOut(AssignedGameResource::collection($assigned_games));
    }
}
