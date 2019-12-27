<?php

namespace App\Http\Controllers\BackendApi\Merchant\System;

use App\Http\Controllers\BackendApi\BackEndApiMainController;
use App\Http\Requests\Backend\Merchant\System\CostomerService\DeleteRequest;
use App\Http\Requests\Backend\Merchant\System\CostomerService\DoAddRequest;
use App\Http\Requests\Backend\Merchant\System\CostomerService\EditRequest;
use App\Http\Requests\Backend\Merchant\System\CostomerService\IndexRequest;
use App\Http\SingleActions\Backend\Merchant\System\CostomerService\DeleteAction;
use App\Http\SingleActions\Backend\Merchant\System\CostomerService\DoAddAction;
use App\Http\SingleActions\Backend\Merchant\System\CostomerService\EditAction;
use App\Http\SingleActions\Backend\Merchant\System\CostomerService\IndexAction;
use Illuminate\Http\JsonResponse;

/**
 * 客服设置
 */
class CostomerServiceController extends BackEndApiMainController
{

    /**
     * 客服设置-列表
     *
     * @param  IndexRequest $request Request.
     * @param  IndexAction  $action  Action.
     * @return JsonResponse
     */
    public function index(IndexRequest $request, IndexAction $action): JsonResponse
    {
        $inputDatas = $request->validated();
        $msgOut     = $action->execute($this, $inputDatas);
        return $msgOut;
    }

    /**
     * 客服设置-添加
     *
     * @param  DoAddRequest $request Request.
     * @param  DoAddAction  $action  Action.
     * @return JsonResponse
     */
    public function doAdd(DoAddRequest $request, DoAddAction $action): JsonResponse
    {
        $inputDatas = $request->validated();
        $msgOut     = $action->execute($this, $inputDatas);
        return $msgOut;
    }

    /**
     * 客服设置-编辑
     *
     * @param  EditRequest $request Request.
     * @param  EditAction  $action  Action.
     * @return JsonResponse
     */
    public function edit(EditRequest $request, EditAction $action): JsonResponse
    {
        $inputDatas = $request->validated();
        $msgOut     = $action->execute($this, $inputDatas);
        return $msgOut;
    }

    /**
     * 客服设置-删除
     *
     * @param  DeleteRequest $request Request.
     * @param  DeleteAction  $action  Action.
     * @return JsonResponse
     */
    public function delete(DeleteRequest $request, DeleteAction $action): JsonResponse
    {
        $inputDatas = $request->validated();
        $msgOut     = $action->execute($this, $inputDatas);
        return $msgOut;
    }
}
