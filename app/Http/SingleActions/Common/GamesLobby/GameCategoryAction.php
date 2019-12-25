<?php

namespace App\Http\SingleActions\Common\GamesLobby;

use App\Http\Requests\Frontend\Common\GameCategoryRequest;
use App\ModelFilters\Game\GameTypePlatformFilter;
use App\Models\Game\GameTypePlatform;
use Illuminate\Http\JsonResponse;

/**
 * Class GameCategoryAction
 * @package App\Http\SingleActions\Common\GamesLobby
 */
class GameCategoryAction
{

    /**
     * @param  GameCategoryRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(GameCategoryRequest $request): JsonResponse
    {
        $validated                = $request->validated();
        $validated['status']      = GameTypePlatform::STATUS;
        $validated['platform_id'] = $request->user()->platform_id;

        $data   = GameTypePlatform::with('gameType:id,name,sign')
            ->filter($validated, GameTypePlatformFilter::class)
            ->withCacheCooldownSeconds(86400)
            ->get(['id', 'type_id', 'platform_id', 'device']);
        $result = msgOut(true, $data);
        return $result;
    }
}
