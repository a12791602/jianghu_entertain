<?php

namespace App\Http\SingleActions\Common\GamesLobby;

use App\Http\Requests\Frontend\Common\GameListRequest;
use App\Http\Resources\GameListResource;
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
     * @param GameListRequest $request GameListRequest.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(GameListRequest $request): JsonResponse
    {
        $user                       = $request->user();
        $inputData                  = $request->validated();
        $inputData['platform_sign'] = $user->platform_sign;

        $result = GamesPlatform::with('games:type_id,sign,name')
           ->filter($inputData, GamesPlatformFilter::class)
           ->get(['id','platform_sign','game_sign']);

        $result = msgOut(true, GameListResource::collection($result));
        return $result;
    }
}
