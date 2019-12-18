<?php

namespace App\Http\Controllers\BackendApi\Merchant\Game;

use App\Http\Controllers\BackendApi\Merchant\MerchantApiMainController;
use App\Http\Requests\Backend\Merchant\Game\DoHotRequest;
use App\Http\Requests\Backend\Merchant\Game\IndexRequest;
use App\Http\Requests\Backend\Merchant\Game\StatusRequest;
use App\Http\SingleActions\Backend\Merchant\Game\DoHotAction;
use App\Http\SingleActions\Backend\Merchant\Game\IndexAction;
use App\Http\SingleActions\Backend\Merchant\Game\StatusAction;
use Illuminate\Http\JsonResponse;

/**
 * Class GameController
 * @package App\Http\Controllers\BackendApi\Merchant\Game
 */
class GameController extends MerchantApiMainController
{
    /**
     * app端游戏列表
     * @param IndexAction  $action  Action.
     * @param IndexRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function appIndex(IndexAction $action, IndexRequest $request): JsonResponse
    {
        $inputDatas  = $request->validated();
        $outputDatas = $action->execute($this, $inputDatas);
        return $outputDatas;
    }

    /**
     * 更改游戏状态
     * @param StatusAction  $action  Action.
     * @param StatusRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function status(StatusAction $action, StatusRequest $request): JsonResponse
    {
        $inputDatas  = $request->validated();
        $outputDatas = $action->execute($inputDatas);
        return $outputDatas;
    }

    /**
     * 设置游戏是否热门
     * @param DoHotAction  $action  Action.
     * @param DoHotRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function doHot(DoHotAction $action, DoHotRequest $request): JsonResponse
    {
        $inputDatas  = $request->validated();
        $outputDatas = $action->execute($inputDatas);
        return $outputDatas;
    }
}
