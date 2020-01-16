<?php

namespace App\Http\SingleActions\Common\GamesLobby;

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
            ->orderBy('balance', 'desc')->limit(100)->get();
        $result      = msgOut(RichListResource::collection($outputDatas));
        return $result;
    }
}
