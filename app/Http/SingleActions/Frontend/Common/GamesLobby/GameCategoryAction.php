<?php

namespace App\Http\SingleActions\Frontend\Common\GamesLobby;

use App\Http\Requests\Frontend\Common\GamesLobby\GameCategoryRequest;
use App\Http\Resources\Frontend\GamesLobby\GameCategoryResource;
use App\Http\SingleActions\MainAction;
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

        $condition['status']      = GameTypePlatform::STATUS_OPEN;
        $condition['platform_id'] = $this->currentPlatformEloq->id;

        $outputDatas = GameTypePlatform::with('gameType:id,name,sign')
            ->filter($condition)->where($condition)->get();
        return msgOut(GameCategoryResource::collection($outputDatas));
    }
}
