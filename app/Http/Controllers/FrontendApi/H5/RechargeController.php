<?php

namespace App\Http\Controllers\FrontendApi\H5;

use App\Http\Controllers\FrontendApi\FrontendApiMainController;
use App\Http\Requests\Frontend\H5\Recharge\ChannelsRequest;
use App\Http\Requests\Frontend\H5\Recharge\TypesRequest;
use App\Http\SingleActions\Frontend\H5\Recharge\ChannelsAction;
use App\Http\SingleActions\Frontend\H5\Recharge\TypesAction;
use Illuminate\Http\JsonResponse;

/**
 * Class RechargeController
 * @package App\Http\Controllers\FrontendApi\H5
 */
class RechargeController extends FrontendApiMainController
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
        $outputs    = $action->execute($this, $inputDatas);
        return $outputs;
    }
}
