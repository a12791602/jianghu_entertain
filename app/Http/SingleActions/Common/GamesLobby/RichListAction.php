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
        $outputDatas = FrontendUsersAccount::with(['frontendUser:account_id,uid,username,mobile'])
            ->orderBy('balance', 'desc')->get();
        $result      = msgOut(true, RichListResource::collection($outputDatas));
        return $result;
    }
}
