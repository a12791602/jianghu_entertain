<?php

namespace App\Http\SingleActions\Frontend\Common\GamesLobby;

use App\Http\Resources\Frontend\GamesLobby\RichListResource;
use App\Models\User\FrontendUsersAccount;
use Illuminate\Http\JsonResponse;

/**
 * Class RichListAction
 *
 * @package App\Http\SingleActions\Frontend\App\GamesLobby
 */
class RichListAction
{
    /**
     * Rich list
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(): JsonResponse
    {
        $outputDatas = FrontendUsersAccount::with(['frontendUser.specificInfo'])
            ->orderBy('balance', 'desc')->limit(config('games_lobby.rich_rank_within'))->get();
        return msgOut(RichListResource::collection($outputDatas));
    }
}
