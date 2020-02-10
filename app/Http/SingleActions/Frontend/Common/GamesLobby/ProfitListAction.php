<?php

namespace App\Http\SingleActions\Frontend\Common\GamesLobby;

use App\Http\Resources\Frontend\GamesLobby\ProfitListResource;
use App\Models\User\FrontendUsersAccount;
use Illuminate\Http\JsonResponse;

/**
 * Class ProfitListAction
 * @package App\Http\SingleActions\Frontend\Common\GamesLobby
 */
class ProfitListAction
{
    /**
     * Profit list
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(): JsonResponse
    {
        ProfitListResource::withoutWrapping();
        $outputDatas = FrontendUsersAccount::with(['frontendUser.specificInfo'])
            ->orderBy('balance', 'desc')->limit(config('games_lobby.show_only_users'))->get();
        $result      = msgOut(ProfitListResource::collection($outputDatas));
        return $result;
    }
}
