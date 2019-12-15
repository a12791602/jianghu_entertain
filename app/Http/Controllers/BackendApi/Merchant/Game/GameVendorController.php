<?php

namespace App\Http\Controllers\BackendApi\Merchant\Game;

use App\Http\Controllers\BackendApi\Merchant\MerchantApiMainController;
use App\Http\Requests\Backend\Merchant\GameVendor\IndexRequest;
use App\Http\Requests\Backend\Merchant\GameVendor\SortRequest;
use App\Http\Requests\Backend\Merchant\GameVendor\StatusRequest;
use App\Http\SingleActions\Backend\Merchant\GameVendor\IndexAction;
use App\Http\SingleActions\Backend\Merchant\GameVendor\SortAction;
use App\Http\SingleActions\Backend\Merchant\GameVendor\StatusAction;
use Illuminate\Http\JsonResponse;

/**
 * Class GameVendorController
 * @package App\Http\Controllers\BackendApi\Merchant\Game
 */
class GameVendorController extends MerchantApiMainController
{
    /**
     * 列表
     * @param IndexAction  $action  Action.
     * @param IndexRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function index(IndexAction $action, IndexRequest $request): JsonResponse
    {
        $inputDatas = $request->validated();
        return $action->execute($this, $inputDatas);
    }

    /**
     * 改表状态
     * @param StatusAction  $action  Action.
     * @param StatusRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function status(StatusAction $action, StatusRequest $request): JsonResponse
    {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * @param SortAction  $action  Action.
     * @param SortRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function sort(SortAction $action, SortRequest $request): JsonResponse
    {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }
}
