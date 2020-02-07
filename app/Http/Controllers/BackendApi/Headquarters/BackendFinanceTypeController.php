<?php

namespace App\Http\Controllers\BackendApi\Headquarters;

use App\Http\Requests\Backend\Headquarters\FinanceType\AddDoRequest;
use App\Http\Requests\Backend\Headquarters\FinanceType\DelDoRequest;
use App\Http\Requests\Backend\Headquarters\FinanceType\EditDoRequest;
use App\Http\Requests\Backend\Headquarters\FinanceType\IndexDoRequest;
use App\Http\Requests\Backend\Headquarters\FinanceType\StatusDoRequest;
use App\Http\SingleActions\Backend\Headquarters\FinanceType\AddDoAction;
use App\Http\SingleActions\Backend\Headquarters\FinanceType\DelDoAction;
use App\Http\SingleActions\Backend\Headquarters\FinanceType\EditDoAction;
use App\Http\SingleActions\Backend\Headquarters\FinanceType\IndexDoAction;
use App\Http\SingleActions\Backend\Headquarters\FinanceType\StatusDoAction;
use Illuminate\Http\JsonResponse;

/**
 * Class BackendFinanceTypeController
 *
 * @package App\Http\Controllers\BackendApi\Headquarters
 */
class BackendFinanceTypeController
{
    /**
     * @param  AddDoAction  $action  Action.
     * @param  AddDoRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function addDo(
        AddDoAction $action,
        AddDoRequest $request
    ): JsonResponse {
        $inputDatas = $request->validated();
        $msgOut     = $action->execute($inputDatas);
        return $msgOut;
    }

    /**
     * @param  IndexDoAction  $action  Action.
     * @param  IndexDoRequest $request Request.
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
     * @param  EditDoAction  $action  Action.
     * @param  EditDoRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function editDo(
        EditDoAction $action,
        EditDoRequest $request
    ): JsonResponse {
        $inputDatas = $request->validated();
        $msgOut     = $action->execute($inputDatas);
        return $msgOut;
    }
    /**
     * @param  DelDoAction  $action  Action.
     * @param  DelDoRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function delDo(
        DelDoAction $action,
        DelDoRequest $request
    ): JsonResponse {
        $inputDatas = $request->validated();
        $msgOut     = $action->execute($inputDatas);
        return $msgOut;
    }

    /**
     * @param  StatusDoAction  $action  Action.
     * @param  StatusDoRequest $request Request.
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
