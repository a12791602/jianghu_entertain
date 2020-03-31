<?php

namespace App\Http\Controllers\BackendApi\Merchant\Activity;

use App\Http\Requests\Backend\Merchant\Activity\Dynamic\IndexRequest;
use App\Http\Requests\Backend\Merchant\Activity\Dynamic\SavePicRequest;
use App\Http\Requests\Backend\Merchant\Activity\Dynamic\StatusRequest;
use App\Http\SingleActions\Backend\Merchant\Activity\Dynamic\IndexAction;
use App\Http\SingleActions\Backend\Merchant\Activity\Dynamic\SavePicAction;
use App\Http\SingleActions\Backend\Merchant\Activity\Dynamic\StatusAction;
use Illuminate\Http\JsonResponse;

/**
 * Class ActivityDynController
 * @package App\Http\Controllers\BackendApi\Merchant\Activity
 */
class ActivityDynController
{
    /**
     * 动态活动列表.
     *
     * @param IndexAction  $action  Action.
     * @param IndexRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function index(IndexAction $action, IndexRequest $request): JsonResponse
    {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * 改变活动状态.
     *
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
     * 保存图片.
     *
     * @param SavePicAction  $action  Action.
     * @param SavePicRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function savePic(SavePicAction $action, SavePicRequest $request): JsonResponse
    {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }
}
