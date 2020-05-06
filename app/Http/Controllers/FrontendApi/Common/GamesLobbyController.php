<?php

namespace App\Http\Controllers\FrontendApi\Common;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Common\GameListRequest;
use App\Http\Requests\Frontend\Common\GamesLobby\GameCategoryRequest;
use App\Http\Requests\Frontend\Common\GamesLobby\InGameBalanceRequest;
use App\Http\Requests\Frontend\Common\GamesLobby\InGameRegisterRequest;
use App\Http\Requests\Frontend\Common\GamesLobby\InGameRequest;
use App\Http\Requests\Frontend\Common\GamesLobby\InGameResetPasswordRequest;
use App\Http\Requests\Frontend\Common\GamesLobby\InGameTxBalanceRequest;
use App\Http\Requests\Frontend\Common\SlidesRequest;
use App\Http\SingleActions\Frontend\Common\GamesLobby\GameCategoryAction;
use App\Http\SingleActions\Frontend\Common\GamesLobby\GameListAction;
use App\Http\SingleActions\Frontend\Common\GamesLobby\InGameAction;
use App\Http\SingleActions\Frontend\Common\GamesLobby\InGameBalanceAction;
use App\Http\SingleActions\Frontend\Common\GamesLobby\InGameRegisterAction;
use App\Http\SingleActions\Frontend\Common\GamesLobby\InGameResetPasswordAction;
use App\Http\SingleActions\Frontend\Common\GamesLobby\InGameTxBalanceAction;
use App\Http\SingleActions\Frontend\Common\GamesLobby\ProfitListAction;
use App\Http\SingleActions\Frontend\Common\GamesLobby\RichListAction;
use App\Http\SingleActions\Frontend\Common\GamesLobby\SlidesAction;
use Illuminate\Http\JsonResponse;

/**
 * Class GamesLobbyController
 * @package App\Http\Controllers\FrontendApi\H5
 */
class GamesLobbyController extends Controller
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

    /**
     * 注册游戏账号 目前只有 IM 有.
     *
     * @param InGameRegisterAction  $action  Action.
     * @param InGameRegisterRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function inGameRegister(
        InGameRegisterAction $action,
        InGameRegisterRequest $request
    ): JsonResponse {
        $validated = $request->validated();
        return $action->execute($validated);
    }

    /**
     * 更新游戏账号密码 目前只有 IM 有
     *
     * @param InGameResetPasswordAction  $action  Action.
     * @param InGameResetPasswordRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function inGameResetPassword(
        InGameResetPasswordAction $action,
        InGameResetPasswordRequest $request
    ): JsonResponse {
        $validated = $request->validated();
        return $action->execute($validated);
    }

    /**
     * 更新游戏账号密码 目前只有 IM 有
     *
     * @param InGameBalanceAction  $action  Action.
     * @param InGameBalanceRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function inGameBalance(
        InGameBalanceAction $action,
        InGameBalanceRequest $request
    ): JsonResponse {
        $validated = $request->validated();
        return $action->execute($validated);
    }

    /**
     * 更新游戏账号密码 目前只有 IM 有
     *
     * @param InGameTxBalanceAction  $action  Action.
     * @param InGameTxBalanceRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function inGameTxBalance(
        InGameTxBalanceAction $action,
        InGameTxBalanceRequest $request
    ): JsonResponse {
        $validated = $request->validated();
        return $action->execute($validated);
    }
}
