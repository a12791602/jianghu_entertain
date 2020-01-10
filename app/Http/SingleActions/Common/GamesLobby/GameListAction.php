<?php

namespace App\Http\SingleActions\Common\GamesLobby;

use App\Http\Controllers\FrontendApi\FrontendApiMainController;
use App\Http\Requests\Frontend\Common\GameListRequest;
use App\Http\Resources\Frontend\GamesLobby\GameListResource;
use App\ModelFilters\Platform\GamesPlatformFilter;
use App\Models\Platform\GamesPlatform;
use Illuminate\Http\JsonResponse;

/**
 * Class GameListAction
 * @package App\Http\SingleActions\Common\GamesLobby
 */
class GameListAction
{

    /**
     * Game list.
     * @param FrontendApiMainController $controller FrontendApiMainController.
     * @param GameListRequest           $request    GameListRequest.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(FrontendApiMainController $controller, GameListRequest $request): JsonResponse
    {
        $condition = [];

        $condition['platform_sign'] = $controller->currentPlatformEloq->sign;

        $condition           = $request->validated();
        $condition['status'] = GamesPlatform::STATUS_OPEN;

        $result = GamesPlatform::with('games')->filter($condition, GamesPlatformFilter::class)->get();

        $result = msgOut(true, GameListResource::collection($result));
        return $result;
    }
}
