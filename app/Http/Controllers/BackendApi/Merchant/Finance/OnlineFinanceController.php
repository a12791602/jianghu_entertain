<?php

namespace App\Http\Controllers\BackendApi\Merchant\Finance;

use App\Http\Controllers\BackendApi\BackEndApiMainController;
use App\Http\Requests\Backend\Merchant\Finance\Online\AddDoRequest;
use App\Http\Requests\Backend\Merchant\Finance\Online\DelDoRequest;
use App\Http\Requests\Backend\Merchant\Finance\Online\EditRequest;
use App\Http\Requests\Backend\Merchant\Finance\Online\IndexRequest;
use App\Http\Requests\Backend\Merchant\Finance\Online\StatusRequest;
use App\Http\SingleActions\Backend\Merchant\Finance\Online\AddDoAction;
use App\Http\SingleActions\Backend\Merchant\Finance\Online\CallbackAction;
use App\Http\SingleActions\Backend\Merchant\Finance\Online\DelDoAction;
use App\Http\SingleActions\Backend\Merchant\Finance\Online\EditAction;
use App\Http\SingleActions\Backend\Merchant\Finance\Online\GetChannelsAction;
use App\Http\SingleActions\Backend\Merchant\Finance\Online\IndexAction;
use App\Http\SingleActions\Backend\Merchant\Finance\Online\StatusAction;
use Illuminate\Http\JsonResponse;

/**
 * Class OnlineFinanceController
 * @package App\Http\Controllers\BackendApi\Merchant\Finance
 */
class OnlineFinanceController extends BackEndApiMainController
{

    /**
     * 获取线上支付渠道
     * @param GetChannelsAction $action Action.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function getChannels(GetChannelsAction $action): JsonResponse
    {
        $outputDatas = $action->execute();
        return $outputDatas;
    }

    /**
     * 添加线上支付方式
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
     * 线上金流列表
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
     * 线上金流编辑
     * @param EditAction  $action  Action.
     * @param EditRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function edit(EditAction $action, EditRequest $request): JsonResponse
    {
        $inputDatas           = $request->validated();
        $inputDatas['method'] = $request->method();
        $outputDatas          = $action->execute($this, $inputDatas);
        return $outputDatas;
    }

    /**
     * 删除线上金流
     * @param DelDoAction  $action  Action.
     * @param DelDoRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function delDo(DelDoAction $action, DelDoRequest $request): JsonResponse
    {
        $inputDatas  = $request->validated();
        $outputDatas = $action->execute($this, $inputDatas);
        return $outputDatas;
    }

    /**
     * 改变状态
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
     * 接收回调信息
     *
     * @param CallbackAction $action   Action.
     * @param string         $platform Platform.
     * @param string         $order    Order.
     * @return string
     * @throws \Exception Exception.
     */
    public function callback(CallbackAction $action, string $platform, string $order): string
    {
        $outputDatas = $action->execute($platform, $order);
        return $outputDatas;
    }
}
