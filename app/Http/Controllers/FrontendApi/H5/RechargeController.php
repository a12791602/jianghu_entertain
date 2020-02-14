<?php

namespace App\Http\Controllers\FrontendApi\H5;

use App\Http\Requests\Frontend\H5\Recharge\CancelRequest;
use App\Http\Requests\Frontend\H5\Recharge\ChannelsRequest;
use App\Http\Requests\Frontend\H5\Recharge\ConfirmRequest;
use App\Http\Requests\Frontend\H5\Recharge\RechargeRequest;
use App\Http\Requests\Frontend\H5\Recharge\TypesRequest;
use App\Http\SingleActions\Frontend\H5\Recharge\CancelAction;
use App\Http\SingleActions\Frontend\H5\Recharge\ChannelsAction;
use App\Http\SingleActions\Frontend\H5\Recharge\ConfirmAction;
use App\Http\SingleActions\Frontend\H5\Recharge\GetFinanceInfoAction;
use App\Http\SingleActions\Frontend\H5\Recharge\RechargeAction;
use App\Http\SingleActions\Frontend\H5\Recharge\TypesAction;
use Illuminate\Http\JsonResponse;

/**
 * Class RechargeController
 * @package App\Http\Controllers\FrontendApi\H5
 */
class RechargeController
{
    /**
     * 获取分类
     * @param TypesAction  $action  Action.
     * @param TypesRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function types(TypesAction $action, TypesRequest $request): JsonResponse
    {
        $inputDatas = $request->validated();
        $outputs    = $action->execute($inputDatas);
        return $outputs;
    }

    /**
     * 获取渠道
     * @param ChannelsAction  $action  Action.
     * @param ChannelsRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function channels(ChannelsAction $action, ChannelsRequest $request): JsonResponse
    {
        $inputDatas = $request->validated();
        $outputs    = $action->execute($inputDatas);
        return $outputs;
    }

    /**
     * 发起充值
     * @param RechargeAction  $action  Action.
     * @param RechargeRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function recharge(RechargeAction $action, RechargeRequest $request): JsonResponse
    {
        $inputDatas       = $request->validated();
        $inputDatas['ip'] = $request->ip();
        $outputs          = $action->execute($inputDatas);
        return $outputs;
    }

    /**
     * 获取分类与渠道.
     *
     * @param GetFinanceInfoAction $action Action.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function getFinanceInfo(GetFinanceInfoAction $action): JsonResponse
    {
        $outputs = $action->execute();
        return $outputs;
    }

    /**
     * 撤销订单.
     *
     * @param CancelAction  $action  Action.
     * @param CancelRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function cancel(
        CancelAction $action,
        CancelRequest $request
    ): JsonResponse {
        $inputDatas = $request->validated();
        $outputs    = $action->execute($inputDatas);
        return $outputs;
    }

    /**
     * 确认付款.
     *
     * @param ConfirmAction  $action  Action.
     * @param ConfirmRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function confirm(
        ConfirmAction $action,
        ConfirmRequest $request
    ): JsonResponse {
        $inputDatas = $request->validated();
        $outputs    = $action->execute($inputDatas);
        return $outputs;
    }
}
