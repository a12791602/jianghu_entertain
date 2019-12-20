<?php

namespace App\Http\SingleActions\Frontend\Common\GamesLobby;

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
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(): JsonResponse
    {
        $outputDatas = FrontendUsersAccount::with('frontendUser.specificInfo')
            ->orderBy('balance', 'desc')
            ->limit(3)
            ->get();
        $result      = msgOut(true, $outputDatas);
        return $result;
    }
}
