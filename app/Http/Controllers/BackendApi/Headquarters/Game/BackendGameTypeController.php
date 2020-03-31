<?php

namespace App\Http\Controllers\BackendApi\Headquarters\Game;

use App\Http\Requests\Backend\Headquarters\Game\GameType\AddDoRequest;
use App\Http\Requests\Backend\Headquarters\Game\GameType\DelDoRequest;
use App\Http\Requests\Backend\Headquarters\Game\GameType\EditDoRequest;
use App\Http\Requests\Backend\Headquarters\Game\GameType\IndexDoRequest;
use App\Http\Requests\Backend\Headquarters\Game\GameType\StatusDoRequest;
use App\Http\SingleActions\Backend\Headquarters\Game\GameType\AddDoAction;
use App\Http\SingleActions\Backend\Headquarters\Game\GameType\DelDoAction;
use App\Http\SingleActions\Backend\Headquarters\Game\GameType\EditDoAction;
use App\Http\SingleActions\Backend\Headquarters\Game\GameType\IndexDoAction;
use App\Http\SingleActions\Backend\Headquarters\Game\GameType\StatusDoAction;
use Illuminate\Http\JsonResponse;

/**
 * Class BackendGameTypeController
 * @package App\Http\Controllers\BackendApi\Headquarters
 */
class BackendGameTypeController
{
    /**
     * @param AddDoAction  $action  Action.
     * @param AddDoRequest $request Request.
     * @return JsonResponse
     * @throws \RuntimeException RuntimeException.
     */
    public function addDo(
        AddDoAction $action,
        AddDoRequest $request
    ): JsonResponse {
        return $action->execute($request);
    }

    /**
     * @param EditDoAction  $action  Action.
     * @param EditDoRequest $request Request.
     * @return JsonResponse
     * @throws \RuntimeException RuntimeException.
     */
    public function editDo(
        EditDoAction $action,
        EditDoRequest $request
    ): JsonResponse {
        return $action->execute($request);
    }

    /**
     * @param IndexDoAction  $action  Action.
     * @param IndexDoRequest $request Request.
     * @return JsonResponse
     * @throws \RuntimeException RuntimeException.
     */
    public function indexDo(
        IndexDoAction $action,
        IndexDoRequest $request
    ): JsonResponse {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * @param DelDoAction  $action  Action.
     * @param DelDoRequest $request Request.
     * @return JsonResponse
     * @throws \RuntimeException RuntimeException.
     */
    public function delDo(
        DelDoAction $action,
        DelDoRequest $request
    ): JsonResponse {
        return $action->execute($request);
    }

    /**
     * @param StatusDoAction  $action  Action.
     * @param StatusDoRequest $request Request.
     * @return JsonResponse
     * @throws \RuntimeException RuntimeRuntimeException.
     */
    public function statusDo(
        StatusDoAction $action,
        StatusDoRequest $request
    ): JsonResponse {
        return $action->execute($request);
    }
}
