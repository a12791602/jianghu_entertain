<?php

namespace App\Http\Controllers\BackendApi\Merchant\Report;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Merchant\Report\GameDetailRequest;
use App\Http\Requests\Backend\Merchant\Report\GameProjectRequest;
use App\Http\Requests\Backend\Merchant\Report\GameRequest;
use App\Http\Requests\Backend\Merchant\Report\PlatformRequest;
use App\Http\Requests\Backend\Merchant\Report\UserAuditRequest;
use App\Http\Requests\Backend\Merchant\Report\UserRequest;
use App\Http\SingleActions\Backend\Merchant\Report\GameAction;
use App\Http\SingleActions\Backend\Merchant\Report\GameDetailAction;
use App\Http\SingleActions\Backend\Merchant\Report\GameProjectAction;
use App\Http\SingleActions\Backend\Merchant\Report\PlatformAction;
use App\Http\SingleActions\Backend\Merchant\Report\UserAction;
use App\Http\SingleActions\Backend\Merchant\Report\UserAuditAction;
use Illuminate\Http\JsonResponse;

/**
 * 报表管理
 */
class ReportController extends Controller
{

    /**
     * 个人报表-列表
     *
     * @param  UserRequest $request Request.
     * @param  UserAction  $action  Action.
     * @return JsonResponse
     */
    public function user(
        UserRequest $request,
        UserAction $action
    ): JsonResponse {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * 游戏报表-列表
     *
     * @param  GameRequest $request Request.
     * @param  GameAction  $action  Action.
     * @return JsonResponse
     */
    public function game(
        GameRequest $request,
        GameAction $action
    ): JsonResponse {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * 游戏报表-详情
     *
     * @param  GameDetailRequest $request Request.
     * @param  GameDetailAction  $action  Action.
     * @return JsonResponse
     */
    public function gameDetail(
        GameDetailRequest $request,
        GameDetailAction $action
    ): JsonResponse {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * 公司报表-列表
     *
     * @param  PlatformRequest $request Request.
     * @param  PlatformAction  $action  Action.
     * @return JsonResponse
     */
    public function platform(
        PlatformRequest $request,
        PlatformAction $action
    ): JsonResponse {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * 平台注单-列表
     *
     * @param  GameProjectRequest $request Request.
     * @param  GameProjectAction  $action  Action.
     * @return JsonResponse
     */
    public function gameProject(
        GameProjectRequest $request,
        GameProjectAction $action
    ): JsonResponse {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * 用户稽核-列表
     *
     * @param  UserAuditRequest $request Request.
     * @param  UserAuditAction  $action  Action.
     * @return JsonResponse
     */
    public function userAudit(
        UserAuditRequest $request,
        UserAuditAction $action
    ): JsonResponse {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }
}
