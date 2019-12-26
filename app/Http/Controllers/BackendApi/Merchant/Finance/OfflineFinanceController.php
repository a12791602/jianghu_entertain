<?php

namespace App\Http\Controllers\BackendApi\Merchant\Finance;

use App\Http\Controllers\BackendApi\BackEndApiMainController;
use App\Http\Requests\Backend\Merchant\Finance\Offline\AddDoRequest;
use App\Http\Requests\Backend\Merchant\Finance\Offline\DelDoRequest;
use App\Http\Requests\Backend\Merchant\Finance\Offline\EditRequest;
use App\Http\Requests\Backend\Merchant\Finance\Offline\IndexRequest;
use App\Http\Requests\Backend\Merchant\Finance\Offline\StatusRequest;
use App\Http\SingleActions\Backend\Merchant\Finance\Offline\AddDoAction;
use App\Http\SingleActions\Backend\Merchant\Finance\Offline\DelDoAction;
use App\Http\SingleActions\Backend\Merchant\Finance\Offline\EditAction;
use App\Http\SingleActions\Backend\Merchant\Finance\Offline\IndexAction;
use App\Http\SingleActions\Backend\Merchant\Finance\Offline\StatusAction;
use App\Http\SingleActions\Backend\Merchant\Finance\Offline\TypesAction;
use Illuminate\Http\JsonResponse;

/**
 * Class OfflineFinanceController
 * @package App\Http\Controllers\BackendApi\Merchant\Finance
 */
class OfflineFinanceController extends BackEndApiMainController
{
    /**
     * 添加线下支付
     * @param AddDoAction  $action  Action.
     * @param AddDoRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function addDo(AddDoAction $action, AddDoRequest $request): JsonResponse
    {
        $inputDatas  = $request->validated();
        $outputDatas = $action->execute($this, $inputDatas);
        return $outputDatas;
    }

    /**
     * 获取线下支付列表
     * @param IndexAction  $action  Action.
     * @param IndexRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function index(IndexAction $action, IndexRequest $request): JsonResponse
    {
        $inputDatas  = $request->validated();
        $outputDatas = $action->execute($this, $inputDatas);
        return $outputDatas;
    }

    /**
     * 获取分类列表
     * @param TypesAction $action Action.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function types(TypesAction $action): JsonResponse
    {
        $outputDatas = $action->execute();
        return $outputDatas;
    }

    /**
     * 删除线下金流
     * @param DelDoAction  $action  Action.
     * @param DelDoRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function delDo(DelDoAction $action, DelDoRequest $request): JsonResponse
    {
        $inputDatas  = $request->validated();
        $outputDatas = $action->execute($inputDatas);
        return $outputDatas;
    }

    /**
     * 线下金流改变状态
     * @param StatusAction  $action  Action.
     * @param StatusRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function status(StatusAction $action, StatusRequest $request): JsonResponse
    {
        $inputDatas  = $request->validated();
        $outputDatas = $action->execute($this, $inputDatas);
        return $outputDatas;
    }

    /**
     * 编辑线下金流
     * @param EditAction  $action  Action.
     * @param EditRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function edit(EditAction $action, EditRequest $request): JsonResponse
    {
        $inputDatas  = $request->validated();
        $outputDatas = $action->execute($this, $inputDatas);
        return $outputDatas;
    }
}
