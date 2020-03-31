<?php

namespace App\Http\Controllers\BackendApi\Headquarters\Setting;

use App\Http\Requests\Backend\Headquarters\Setting\SmsConfig\DeleteRequest;
use App\Http\Requests\Backend\Headquarters\Setting\SmsConfig\DoAddRequest;
use App\Http\Requests\Backend\Headquarters\Setting\SmsConfig\EditRequest;
use App\Http\Requests\Backend\Headquarters\Setting\SmsConfig\IndexRequest;
use App\Http\Requests\Backend\Headquarters\Setting\SmsConfig\StatusRequest;
use App\Http\SingleActions\Backend\Headquarters\Setting\SmsConfig\DeleteAction;
use App\Http\SingleActions\Backend\Headquarters\Setting\SmsConfig\DoAddAction;
use App\Http\SingleActions\Backend\Headquarters\Setting\SmsConfig\EditAction;
use App\Http\SingleActions\Backend\Headquarters\Setting\SmsConfig\IndexAction;
use App\Http\SingleActions\Backend\Headquarters\Setting\SmsConfig\StatusAction;
use Illuminate\Http\JsonResponse;

/**
 * 短信配置
 */
class SmsConfigController
{
    /**
     * 短信配置-列表
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
     * 短信配置-添加
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
     * 短信配置-编辑
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
     * 短信配置-删除
     * @param  DeleteRequest $request Request.
     * @param  DeleteAction  $action  Action.
     * @return JsonResponse
     */
    public function delete(DeleteRequest $request, DeleteAction $action): JsonResponse
    {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * 短信配置-修改状态
     * @param  StatusRequest $request Request.
     * @param  StatusAction  $action  Action.
     * @return JsonResponse
     */
    public function status(StatusRequest $request, StatusAction $action): JsonResponse
    {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }
}
