<?php

namespace App\Http\Controllers\BackendApi\Headquarters\Game;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Headquarters\Game\GameVendor\AddDoRequest;
use App\Http\Requests\Backend\Headquarters\Game\GameVendor\DelDoRequest;
use App\Http\Requests\Backend\Headquarters\Game\GameVendor\EditDoRequest;
use App\Http\Requests\Backend\Headquarters\Game\GameVendor\IndexDoRequest;
use App\Http\SingleActions\Backend\Headquarters\Game\GameVendor\AddDoAction;
use App\Http\SingleActions\Backend\Headquarters\Game\GameVendor\DelDoAction;
use App\Http\SingleActions\Backend\Headquarters\Game\GameVendor\EditDoAction;
use App\Http\SingleActions\Backend\Headquarters\Game\GameVendor\IndexDoAction;
use Illuminate\Http\JsonResponse;

/**
 * Class BackendGameVendorController
 *
 * @package App\Http\Controllers\BackendApi\Headquarters
 */
class BackendGameVendorController extends Controller
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
}
