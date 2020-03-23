<?php

namespace App\Http\Controllers\BackendApi\Headquarters;

use App\Http\Requests\Backend\Headquarters\GameType\AddDoRequest;
use App\Http\Requests\Backend\Headquarters\GameType\DelDoRequest;
use App\Http\Requests\Backend\Headquarters\GameType\EditDoRequest;
use App\Http\Requests\Backend\Headquarters\GameType\IndexDoRequest;
use App\Http\Requests\Backend\Headquarters\GameType\StatusDoRequest;
use App\Http\SingleActions\Backend\Headquarters\GameType\AddDoAction;
use App\Http\SingleActions\Backend\Headquarters\GameType\DelDoAction;
use App\Http\SingleActions\Backend\Headquarters\GameType\EditDoAction;
use App\Http\SingleActions\Backend\Headquarters\GameType\IndexDoAction;
use App\Http\SingleActions\Backend\Headquarters\GameType\StatusDoAction;
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
        $msgOut = $action->execute($request);
        return $msgOut;
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
        $msgOut = $action->execute($request);
        return $msgOut;
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
        $msgOut     = $action->execute($inputDatas);
        return $msgOut;
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
        $msgOut = $action->execute($request);
        return $msgOut;
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
        $msgOut = $action->execute($request);
        return $msgOut;
    }
}
