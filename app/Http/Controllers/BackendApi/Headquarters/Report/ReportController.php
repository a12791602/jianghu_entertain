<?php

namespace App\Http\Controllers\BackendApi\Headquarters\Report;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Headquarters\Report\GameProjectRequest;
use App\Http\Requests\Backend\Headquarters\Report\GameVendorRequest;
use App\Http\Requests\Backend\Headquarters\Report\PlatformGameRequest;
use App\Http\SingleActions\Backend\Headquarters\Report\GameProjectAction;
use App\Http\SingleActions\Backend\Headquarters\Report\GameVendorAction;
use App\Http\SingleActions\Backend\Headquarters\Report\PlatformGameAction;
use Illuminate\Http\JsonResponse;

/**
 * 报表管理
 */
class ReportController extends Controller
{
    /**
     * 厅主注单-列表
     *
     * @param  GameProjectRequest $request Request.
     * @param  GameProjectAction  $action  Action.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function gameProject(
        GameProjectRequest $request,
        GameProjectAction $action
    ): JsonResponse {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * 第三方游戏报表-列表
     *
     * @param  GameVendorRequest $request Request.
     * @param  GameVendorAction  $action  Action.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function gameVendor(
        GameVendorRequest $request,
        GameVendorAction $action
    ): JsonResponse {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * 厅主游戏报表
     * @param  PlatformGameRequest $request Request.
     * @param  PlatformGameAction  $action  Action.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function platformGame(
        PlatformGameRequest $request,
        PlatformGameAction $action
    ): JsonResponse {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }
}
