<?php

namespace App\Http\Controllers\BackendApi\Merchant\Activity;

use App\Http\Requests\Backend\Merchant\Activity\Statically\AddDoRequest;
use App\Http\Requests\Backend\Merchant\Activity\Statically\DelDoRequest;
use App\Http\Requests\Backend\Merchant\Activity\Statically\EditRequest;
use App\Http\Requests\Backend\Merchant\Activity\Statically\IndexRequest;
use App\Http\Requests\Backend\Merchant\Activity\Statically\StatusRequest;
use App\Http\SingleActions\Backend\Merchant\Activity\Statically\AddDoAction;
use App\Http\SingleActions\Backend\Merchant\Activity\Statically\DelDoAction;
use App\Http\SingleActions\Backend\Merchant\Activity\Statically\EditAction;
use App\Http\SingleActions\Backend\Merchant\Activity\Statically\IndexAction;
use App\Http\SingleActions\Backend\Merchant\Activity\Statically\StatusAction;
use Illuminate\Http\JsonResponse;

/**
 * Class ActivityStaticController
 * @package App\Http\Controllers\BackendApi\Merchant\Activity
 */
class ActivityStaticController
{
    /**
     * 系统公告添加.
     *
     * @param AddDoAction  $action  Action.
     * @param AddDoRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function addDo(AddDoAction $action, AddDoRequest $request): JsonResponse
    {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * 编辑系统公告.
     *
     * @param EditAction  $action  Action.
     * @param EditRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function edit(EditAction $action, EditRequest $request): JsonResponse
    {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * 系统公告列表.
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
     * 系统公告删除.
     *
     * @param DelDoAction  $action  Action.
     * @param DelDoRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function delDo(DelDoAction $action, DelDoRequest $request): JsonResponse
    {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * 系统公告改变状态.
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
}
