<?php

namespace App\Http\Controllers\BackendApi\Headquarters;

use App\Http\Requests\Backend\Headquarters\GameVendor\AddDoRequest;
use App\Http\Requests\Backend\Headquarters\GameVendor\DelDoRequest;
use App\Http\Requests\Backend\Headquarters\GameVendor\EditDoRequest;
use App\Http\Requests\Backend\Headquarters\GameVendor\IndexDoRequest;
use App\Http\SingleActions\Backend\Headquarters\GameVendor\AddDoAction;
use App\Http\SingleActions\Backend\Headquarters\GameVendor\DelDoAction;
use App\Http\SingleActions\Backend\Headquarters\GameVendor\EditDoAction;
use App\Http\SingleActions\Backend\Headquarters\GameVendor\IndexDoAction;
use Illuminate\Http\JsonResponse;

/**
 * Class BackendGameVendorController
 *
 * @package App\Http\Controllers\BackendApi\Headquarters
 */
class BackendGameVendorController
{
    /**
     * @param  AddDoAction  $action  Action.
     * @param  AddDoRequest $request Request.
     * @return \Illuminate\Http\JsonResponse
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
}
