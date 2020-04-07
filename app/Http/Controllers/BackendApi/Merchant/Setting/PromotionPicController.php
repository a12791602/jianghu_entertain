<?php

namespace App\Http\Controllers\BackendApi\Merchant\Setting;

use App\Http\Requests\Backend\Merchant\Setting\PromotionPic\DeleteRequest;
use App\Http\Requests\Backend\Merchant\Setting\PromotionPic\DoAddRequest;
use App\Http\Requests\Backend\Merchant\Setting\PromotionPic\EditRequest;
use App\Http\Requests\Backend\Merchant\Setting\PromotionPic\IndexRequest;
use App\Http\SingleActions\Backend\Merchant\Setting\PromotionPic\DeleteAction;
use App\Http\SingleActions\Backend\Merchant\Setting\PromotionPic\DoAddAction;
use App\Http\SingleActions\Backend\Merchant\Setting\PromotionPic\EditAction;
use App\Http\SingleActions\Backend\Merchant\Setting\PromotionPic\IndexAction;
use Illuminate\Http\JsonResponse;

/**
 * 推广图片
 */
class PromotionPicController
{

    /**
     * 推广图片-列表
     *
     * @param  IndexRequest $request Request.
     * @param  IndexAction  $action  Action.
     * @return JsonResponse
     */
    public function index(IndexRequest $request, IndexAction $action): JsonResponse
    {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * 推广图片-添加
     *
     * @param  DoAddRequest $request Request.
     * @param  DoAddAction  $action  Action.
     * @return JsonResponse
     */
    public function doAdd(DoAddRequest $request, DoAddAction $action): JsonResponse
    {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * 推广图片-编辑
     *
     * @param  EditRequest $request Request.
     * @param  EditAction  $action  Action.
     * @return JsonResponse
     */
    public function edit(EditRequest $request, EditAction $action): JsonResponse
    {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * 推广图片-删除
     *
     * @param  DeleteRequest $request Request.
     * @param  DeleteAction  $action  Action.
     * @return JsonResponse
     */
    public function delete(DeleteRequest $request, DeleteAction $action): JsonResponse
    {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }
}
