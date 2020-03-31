<?php

namespace App\Http\Controllers\BackendApi\Headquarters\Finance;

use App\Http\Requests\Backend\Headquarters\Finance\FinanceType\AddDoRequest;
use App\Http\Requests\Backend\Headquarters\Finance\FinanceType\DelDoRequest;
use App\Http\Requests\Backend\Headquarters\Finance\FinanceType\EditDoRequest;
use App\Http\Requests\Backend\Headquarters\Finance\FinanceType\IndexDoRequest;
use App\Http\Requests\Backend\Headquarters\Finance\FinanceType\StatusDoRequest;
use App\Http\SingleActions\Backend\Headquarters\Finance\FinanceType\AddDoAction;
use App\Http\SingleActions\Backend\Headquarters\Finance\FinanceType\DelDoAction;
use App\Http\SingleActions\Backend\Headquarters\Finance\FinanceType\EditDoAction;
use App\Http\SingleActions\Backend\Headquarters\Finance\FinanceType\IndexDoAction;
use App\Http\SingleActions\Backend\Headquarters\Finance\FinanceType\StatusDoAction;
use Illuminate\Http\JsonResponse;

/**
 * Class BackendFinanceTypeController
 *
 * @package App\Http\Controllers\BackendApi\Headquarters\Finance
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
        return $action->execute($inputDatas);
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
        return $action->execute($inputDatas);
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
        return $action->execute($inputDatas);
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
        return $action->execute($inputDatas);
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
        return $action->execute($inputDatas);
    }
}
