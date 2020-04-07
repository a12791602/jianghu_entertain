<?php

namespace App\Http\Controllers\BackendApi\Merchant\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Merchant\Setting\CostomerService\DeleteRequest;
use App\Http\Requests\Backend\Merchant\Setting\CostomerService\DoAddRequest;
use App\Http\Requests\Backend\Merchant\Setting\CostomerService\EditRequest;
use App\Http\Requests\Backend\Merchant\Setting\CostomerService\IndexRequest;
use App\Http\SingleActions\Backend\Merchant\Setting\CostomerService\DeleteAction;
use App\Http\SingleActions\Backend\Merchant\Setting\CostomerService\DoAddAction;
use App\Http\SingleActions\Backend\Merchant\Setting\CostomerService\EditAction;
use App\Http\SingleActions\Backend\Merchant\Setting\CostomerService\IndexAction;
use Illuminate\Http\JsonResponse;

/**
 * 客服设置
 */
class CostomerServiceController extends Controller
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
        return $action->execute($inputDatas);
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
        return $action->execute($inputDatas);
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
        return $action->execute($inputDatas);
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
        return $action->execute($inputDatas);
    }
}
