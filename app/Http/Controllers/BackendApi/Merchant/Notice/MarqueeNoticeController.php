<?php

namespace App\Http\Controllers\BackendApi\Merchant\Notice;

use App\Http\Requests\Backend\Merchant\Notice\Marquee\AddDoRequest;
use App\Http\Requests\Backend\Merchant\Notice\Marquee\DelDoRequest;
use App\Http\Requests\Backend\Merchant\Notice\Marquee\EditRequest;
use App\Http\Requests\Backend\Merchant\Notice\Marquee\IndexRequest;
use App\Http\Requests\Backend\Merchant\Notice\Marquee\StatusRequest;
use App\Http\SingleActions\Backend\Merchant\Notice\Marquee\AddDoAction;
use App\Http\SingleActions\Backend\Merchant\Notice\Marquee\DelDoAction;
use App\Http\SingleActions\Backend\Merchant\Notice\Marquee\EditAction;
use App\Http\SingleActions\Backend\Merchant\Notice\Marquee\IndexAction;
use App\Http\SingleActions\Backend\Merchant\Notice\Marquee\StatusAction;
use Illuminate\Http\JsonResponse;

/**
 * 跑马灯公告控制器.
 *
 * Class MarqueeNoticeController
 * @package App\Http\Controllers\BackendApi\Merchant\Notice
 */
class MarqueeNoticeController
{
    /**
     * 添加跑马灯公告.
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
     * 跑马灯公告列表.
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
     * 跑马灯公告编辑.
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
     * 跑马灯公告删除.
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
     * 跑马灯公告改变状态.
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
