<?php

namespace App\Http\Controllers\BackendApi\Merchant\System;

use App\Http\Controllers\BackendApi\BackEndApiMainController;
use App\Http\Requests\Backend\Merchant\System\HelpCenter\DeleteRequest;
use App\Http\Requests\Backend\Merchant\System\HelpCenter\DoAddRequest;
use App\Http\Requests\Backend\Merchant\System\HelpCenter\EditRequest;
use App\Http\Requests\Backend\Merchant\System\HelpCenter\IndexRequest;
use App\Http\SingleActions\Backend\Merchant\System\HelpCenter\DeleteAction;
use App\Http\SingleActions\Backend\Merchant\System\HelpCenter\DoAddAction;
use App\Http\SingleActions\Backend\Merchant\System\HelpCenter\EditAction;
use App\Http\SingleActions\Backend\Merchant\System\HelpCenter\IndexAction;
use Illuminate\Http\JsonResponse;

/**
 * 帮助设置
 */
class HelpCenterController extends BackEndApiMainController
{

    /**
     * 帮助设置-列表
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
     * 帮助设置-添加
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
     * 帮助设置-编辑
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
     * 帮助设置-删除
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
