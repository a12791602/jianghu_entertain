<?php

namespace App\Http\Controllers\FrontendApi\H5;

use App\Http\Controllers\FrontendApi\FrontendApiMainController;
use App\Http\Requests\Frontend\Common\GameCategoryRequest;
use App\Http\Requests\Frontend\Common\GameListRequest;
use App\Http\SingleActions\Common\GamesLobby\GameCategoryAction;
use App\Http\SingleActions\Common\GamesLobby\GameListAction;
use App\Http\SingleActions\Common\GamesLobby\RichListAction;
use Illuminate\Http\JsonResponse;

/**
 * Class GamesLobbyController
 * @package App\Http\Controllers\FrontendApi\H5
 */
class GamesLobbyController extends FrontendApiMainController
{

    /**
     * 今日富豪榜.
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
     * @param  GameCategoryAction  $action  Action.
     * @param  GameCategoryRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function category(GameCategoryAction $action, GameCategoryRequest $request): JsonResponse
    {
        $result = $action->execute($request);
        return $result;
    }

    /**
     * game list.
     * @param GameListAction  $action  Action.
     * @param GameListRequest $request Request.
     * @return mixed
     */
    public function gameList(GameListAction $action, GameListRequest $request)
    {
        $result = $action->execute($request);
        return $result;
    }
}
