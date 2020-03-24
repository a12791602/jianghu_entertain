<?php

namespace App\Http\Controllers\BackendApi\Headquarters\Finance;

use App\Http\Requests\Backend\Headquarters\Finance\FinanceVendor\AddDoRequest;
use App\Http\Requests\Backend\Headquarters\Finance\FinanceVendor\DelDoRequest;
use App\Http\Requests\Backend\Headquarters\Finance\FinanceVendor\EditDoRequest;
use App\Http\Requests\Backend\Headquarters\Finance\FinanceVendor\IndexDoRequest;
use App\Http\Requests\Backend\Headquarters\Finance\FinanceVendor\StatusDoRequest;
use App\Http\SingleActions\Backend\Headquarters\Finance\FinanceVendor\AddDoAction;
use App\Http\SingleActions\Backend\Headquarters\Finance\FinanceVendor\DelDoAction;
use App\Http\SingleActions\Backend\Headquarters\Finance\FinanceVendor\EditDoAction;
use App\Http\SingleActions\Backend\Headquarters\Finance\FinanceVendor\IndexDoAction;
use App\Http\SingleActions\Backend\Headquarters\Finance\FinanceVendor\StatusDoAction;
use Illuminate\Http\JsonResponse;

/**
 * Class BackendFinanceVendorController
 *
 * @package App\Http\Controllers\BackendApi\Headquarters\Finance
 */
class BackendFinanceVendorController
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
