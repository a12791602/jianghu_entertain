<?php

namespace App\Http\Controllers\FrontendApi\App;

use App\Http\Controllers\FrontendApi\FrontendApiMainController;
use App\Http\SingleActions\Frontend\Common\GamesLobby\GameCategoryAction;
use App\Http\SingleActions\Frontend\Common\GamesLobby\RichListAction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class GamesLobbyController
 * @package App\Http\Controllers\FrontendApi\H5
 */
class GamesLobbyController extends FrontendApiMainController
{

    /**
     * 今日富豪榜.
     *
     * @param  RichListAction $action Action.
     * @return JsonResponse.
     * @throws \Exception Exception.
     */
    public function richList(RichListAction $action): JsonResponse
    {
        $result = $action->execute();
        return $result;
    }

    /**
     * game category
     * @param  GameCategoryAction $action  Action.
     * @param  Request            $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function category(GameCategoryAction $action, Request $request): JsonResponse
    {
        $result = $action->execute($request);
        return $result;
    }
}
