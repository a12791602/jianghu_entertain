<?php

namespace App\Http\SingleActions\Frontend\Common\GamesLobby;

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

        $outputDatas = GameTypePlatform::where($condition)
            ->with('gameType:id,name,sign,created_at')
            ->first()
            ->getRelation('gameType');
        $result      = msgOut(true, $outputDatas);
        return $result;
    }
}
