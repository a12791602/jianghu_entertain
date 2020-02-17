<?php

namespace App\Http\Controllers\BackendApi\Merchant\Game;

use App\Http\Requests\Backend\Merchant\GameVendor\IndexRequest;
use App\Http\Requests\Backend\Merchant\GameVendor\SortRequest;
use App\Http\Requests\Backend\Merchant\GameVendor\StatusRequest;
use App\Http\Requests\Backend\Merchant\GameVendor\UploadRequest;
use App\Http\SingleActions\Backend\Merchant\GameVendor\IndexAction;
use App\Http\SingleActions\Backend\Merchant\GameVendor\SortAction;
use App\Http\SingleActions\Backend\Merchant\GameVendor\StatusAction;
use App\Http\SingleActions\Backend\Merchant\GameVendor\UploadAction;
use Illuminate\Http\JsonResponse;

/**
 * Class GameVendorController
 * @package App\Http\Controllers\BackendApi\Merchant\Game
 */
class GameVendorController
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
        $inputDatas  = $request->validated();
        $outputDatas = $action->execute($inputDatas);
        return $outputDatas;
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
        $inputDatas  = $request->validated();
        $outputDatas = $action->execute($inputDatas);
        return $outputDatas;
    }

    /**
     * @param SortAction  $action  Action.
     * @param SortRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function sort(SortAction $action, SortRequest $request): JsonResponse
    {
        $inputDatas  = $request->validated();
        $outputDatas = $action->execute($inputDatas);
        return $outputDatas;
    }

    /**
     * 上传图片.
     *
     * @param UploadAction  $action  Action.
     * @param UploadRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function upload(UploadAction $action, UploadRequest $request): JsonResponse
    {
        $inputDatas  = $request->validated();
        $outputDatas = $action->execute($inputDatas);
        return $outputDatas;
    }
}
