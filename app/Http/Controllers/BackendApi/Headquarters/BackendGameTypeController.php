<?php

namespace App\Http\Controllers\BackendApi\Headquarters;

use App\Http\Requests\Backend\Headquarters\GameType\AddRequest;
use App\Http\Requests\Backend\Headquarters\GameType\DelRequest;
use App\Http\Requests\Backend\Headquarters\GameType\EditRequest;
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
     * @param AddDoAction $action  Action.
     * @param AddRequest  $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function addDo(
        AddDoAction $action,
        AddRequest $request
    ): JsonResponse {
        $inputDatas = $request->validated();
        $msgOut     = $action->execute($inputDatas);
        return $msgOut;
    }

    /**
     * @param EditDoAction $action  Action.
     * @param EditRequest  $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function editDo(
        EditDoAction $action,
        EditRequest $request
    ): JsonResponse {
        $inputDatas = $request->validated();
        $msgOut     = $action->execute($inputDatas);
        return $msgOut;
    }

    /**
     * @param IndexDoAction  $action  Action.
     * @param IndexDoRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
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
     * @param DelDoAction $action  Action.
     * @param DelRequest  $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function delDo(
        DelDoAction $action,
        DelRequest $request
    ): JsonResponse {
        $inputDatas = $request->validated();
        $msgOut     = $action->execute($inputDatas);
        return $msgOut;
    }

    /**
     * @param StatusDoAction  $action  Action.
     * @param StatusDoRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function statusDo(
        StatusDoAction $action,
        StatusDoRequest $request
    ): JsonResponse {
        $inputDatas = $request->validated();
        $msgOut     = $action->execute($inputDatas);
        return $msgOut;
    }
}
