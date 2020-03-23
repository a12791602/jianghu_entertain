<?php

namespace App\Http\Controllers\BackendApi\Merchant\Game;

use App\Http\Requests\Backend\Merchant\Game\DoHotRequest;
use App\Http\Requests\Backend\Merchant\Game\IndexRequest;
use App\Http\Requests\Backend\Merchant\Game\MaintainRequest;
use App\Http\Requests\Backend\Merchant\Game\RecommendRequest;
use App\Http\Requests\Backend\Merchant\Game\SortRequest;
use App\Http\Requests\Backend\Merchant\Game\StatusRequest;
use App\Http\Requests\Backend\Merchant\Game\UploadRequest;
use App\Http\SingleActions\Backend\Merchant\Game\DoHotAction;
use App\Http\SingleActions\Backend\Merchant\Game\GetSearchConditionDataAction;
use App\Http\SingleActions\Backend\Merchant\Game\IndexAction;
use App\Http\SingleActions\Backend\Merchant\Game\MaintainAction;
use App\Http\SingleActions\Backend\Merchant\Game\RecommendAction;
use App\Http\SingleActions\Backend\Merchant\Game\SortAction;
use App\Http\SingleActions\Backend\Merchant\Game\StatusAction;
use App\Http\SingleActions\Backend\Merchant\Game\UploadAction;
use Illuminate\Http\JsonResponse;

/**
 * Class GameController
 * @package App\Http\Controllers\BackendApi\Merchant\Game
 */
class GameController
{

    /**
     * (app/pc/h5)端游戏列表
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

    /**
     * 游戏排序
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
     * 更改游戏是否维护
     * @param MaintainAction  $action  Action.
     * @param MaintainRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function maintain(MaintainAction $action, MaintainRequest $request): JsonResponse
    {
        $inputDatas  = $request->validated();
        $outputDatas = $action->execute($inputDatas);
        return $outputDatas;
    }

    /**
     * 更改游戏是否推荐
     * @param RecommendAction  $action  Action.
     * @param RecommendRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function recommend(RecommendAction $action, RecommendRequest $request): JsonResponse
    {
        $inputDatas  = $request->validated();
        $outputDatas = $action->execute($inputDatas);
        return $outputDatas;
    }

    /**
     * 获得查询条件
     * @param GetSearchConditionDataAction $action Action.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function getSearchConditionData(GetSearchConditionDataAction $action): JsonResponse
    {
        $outputDatas = $action->execute();
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
