<?php

namespace App\Http\Controllers\FrontendApi\Common;

use App\Http\Requests\Frontend\Common\GameListRequest;
use App\Http\Requests\Frontend\Common\GamesLobby\GameCategoryRequest;
use App\Http\Requests\Frontend\Common\GamesLobby\InGameRequest;
use App\Http\Requests\Frontend\Common\SlidesRequest;
use App\Http\SingleActions\Frontend\Common\GamesLobby\GameCategoryAction;
use App\Http\SingleActions\Frontend\Common\GamesLobby\GameListAction;
use App\Http\SingleActions\Frontend\Common\GamesLobby\InGameAction;
use App\Http\SingleActions\Frontend\Common\GamesLobby\ProfitListAction;
use App\Http\SingleActions\Frontend\Common\GamesLobby\RichListAction;
use App\Http\SingleActions\Frontend\Common\GamesLobby\SlidesAction;
use Illuminate\Http\JsonResponse;

/**
 * Class GamesLobbyController
 * @package App\Http\Controllers\FrontendApi\H5
 */
class GamesLobbyController
{

    /**
     * Rich list.
     * @param  RichListAction $action RichListAction.
     * @return JsonResponse.
     * @throws \Exception Exception.
     */
    public function richList(RichListAction $action): JsonResponse
    {
        return $action->execute();
    }

    /**
     * Game lobby profit list.
     * @param ProfitListAction $action ProfitListAction.
     * @return JsonResponse.
     * @throws \Exception Exception.
     */
    public function profitList(ProfitListAction $action): JsonResponse
    {
        return $action->execute();
    }

    /**
     * Game category
     * @param  GameCategoryAction  $action  Action.
     * @param  GameCategoryRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function category(
        GameCategoryAction $action,
        GameCategoryRequest $request
    ): JsonResponse {
        return $action->execute($request);
    }

    /**
     * Game list.
     * @param GameListRequest $request Request.
     * @param GameListAction  $action  Action.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function gameList(GameListRequest $request, GameListAction $action): JsonResponse
    {
        $validated = $request->validated();
        return $action->execute($validated);
    }

    /**
     * Home carousel slides.
     * @param SlidesAction  $action  SlidesAction.
     * @param SlidesRequest $request SlidesRequest.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function slides(SlidesAction $action, SlidesRequest $request): JsonResponse
    {
        $validated = $request->validated();
        return $action->execute($validated);
    }

    /**
     * 进入游戏.
     *
     * @param InGameAction  $action  Action.
     * @param InGameRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function inGame(InGameAction $action, InGameRequest $request): JsonResponse
    {
        $validated = $request->validated();
        return $action->execute($validated);
    }
}
