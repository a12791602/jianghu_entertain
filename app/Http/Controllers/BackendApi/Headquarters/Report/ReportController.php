<?php

namespace App\Http\Controllers\BackendApi\Headquarters\Report;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Headquarters\Report\GameProjectRequest;
use App\Http\SingleActions\Backend\Headquarters\Report\GameProjectAction;
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
}
