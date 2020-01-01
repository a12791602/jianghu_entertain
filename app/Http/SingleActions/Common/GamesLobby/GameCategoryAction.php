<?php

namespace App\Http\SingleActions\Common\GamesLobby;

use App\Http\Resources\Frontend\GamesLobby\GameCategoryResource;
use App\Models\Game\GameTypePlatform;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class GameCategoryAction
 * @package App\Http\SingleActions\Frontend\Common\GamesLobby
 */
class GameCategoryAction
{

    /**
     * Game category
     * @param  Request $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(Request $request): JsonResponse
    {
        $user      = $request->user();
        $condition = [
            'status' => GameTypePlatform::STATUS,
            'device' => GameTypePlatform::DEVICE_H5,
            'platform_id' => $user->platform_id,
        ];

        $outputDatas = GameTypePlatform::with('gameType:id,name,sign')->where($condition)->get();
        $result      = msgOut(true, GameCategoryResource::collection($outputDatas));
        return $result;
    }
}
