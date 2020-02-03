<?php

namespace App\Http\SingleActions\Frontend\Common\GamesLobby;

use App\Http\Requests\Frontend\Common\GameListRequest;
use App\Http\Resources\Frontend\GamesLobby\GameListResource;
use App\Http\SingleActions\MainAction;
use App\ModelFilters\Platform\GamesPlatformFilter;
use App\Models\Platform\GamesPlatform;
use Illuminate\Http\JsonResponse;

/**
 * Class GameListAction
 * @package App\Http\SingleActions\Frontend\Common\GamesLobby
 */
class GameListAction extends MainAction
{

    /**
     * Game list.
     * @param GameListRequest $request GameListRequest.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(
        GameListRequest $request
    ): JsonResponse {
        $condition = [];

        $condition['platform_sign'] = $this->currentPlatformEloq->sign;

        $condition           = $request->validated();
        $condition['status'] = GamesPlatform::STATUS_OPEN;

        $result = GamesPlatform::with('games')->filter($condition, GamesPlatformFilter::class)->get();

        $result = msgOut(GameListResource::collection($result));
        return $result;
    }
}
