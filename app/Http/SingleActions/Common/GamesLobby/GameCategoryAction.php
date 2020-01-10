<?php

namespace App\Http\SingleActions\Common\GamesLobby;

use App\Http\Controllers\FrontendApi\FrontendApiMainController;
use App\Http\Requests\Frontend\Common\GamesLobby\GameCategoryRequest;
use App\Http\Resources\Frontend\GamesLobby\GameCategoryResource;
use App\ModelFilters\Game\GameTypePlatformFilter;
use App\Models\Game\GameTypePlatform;
use Illuminate\Http\JsonResponse;

/**
 * Class GameCategoryAction
 * @package App\Http\SingleActions\Frontend\Common\GamesLobby
 */
class GameCategoryAction
{

    /**
     * Game category
     * @param FrontendApiMainController $controller FrontendApiMainController.
     * @param GameCategoryRequest       $request    GameCategoryRequest.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(FrontendApiMainController $controller, GameCategoryRequest $request): JsonResponse
    {
        $condition = $request->validated();

        $condition['status']      = GameTypePlatform::STATUS;
        $condition['platform_id'] = $controller->currentPlatformEloq->id;

        $outputDatas = GameTypePlatform::with('gameType:id,name,sign')
            ->filter($condition, GameTypePlatformFilter::class)->where($condition)->get();
        $result      = msgOut(true, GameCategoryResource::collection($outputDatas));
        return $result;
    }
}
