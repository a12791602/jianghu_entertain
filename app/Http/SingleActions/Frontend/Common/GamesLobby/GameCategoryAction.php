<?php

namespace App\Http\SingleActions\Frontend\Common\GamesLobby;

use App\Http\Requests\Frontend\Common\GamesLobby\GameCategoryRequest;
use App\Http\Resources\Frontend\GamesLobby\GameCategoryResource;
use App\Http\SingleActions\MainAction;
use App\ModelFilters\Game\GameTypePlatformFilter;
use App\Models\Game\GameTypePlatform;
use Illuminate\Http\JsonResponse;

/**
 * Class GameCategoryAction
 * @package App\Http\SingleActions\Frontend\Common\GamesLobby
 */
class GameCategoryAction extends MainAction
{

    /**
     * Game category
     * @param GameCategoryRequest $request GameCategoryRequest.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(GameCategoryRequest $request): JsonResponse
    {
        $condition = $request->validated();

        $condition['status']      = GameTypePlatform::STATUS;
        $condition['platform_id'] = $this->currentPlatformEloq->id;

        $outputDatas = GameTypePlatform::with('gameType:id,name,sign')
            ->filter($condition, GameTypePlatformFilter::class)->where($condition)->get();
        $result      = msgOut(GameCategoryResource::collection($outputDatas));
        return $result;
    }
}
