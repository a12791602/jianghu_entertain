<?php

namespace App\Http\Controllers\BackendApi\Merchant\Notice;

use App\Http\Requests\Backend\Merchant\Notice\System\AddDoRequest;
use App\Http\Requests\Backend\Merchant\Notice\System\DelDoRequest;
use App\Http\Requests\Backend\Merchant\Notice\System\EditRequest;
use App\Http\Requests\Backend\Merchant\Notice\System\IndexRequest;
use App\Http\Requests\Backend\Merchant\Notice\System\StatusRequest;
use App\Http\SingleActions\Backend\Merchant\Notice\System\AddDoAction;
use App\Http\SingleActions\Backend\Merchant\Notice\System\DelDoAction;
use App\Http\SingleActions\Backend\Merchant\Notice\System\EditAction;
use App\Http\SingleActions\Backend\Merchant\Notice\System\IndexAction;
use App\Http\SingleActions\Backend\Merchant\Notice\System\StatusAction;
use Illuminate\Http\JsonResponse;

/**
 * Class SystemNoticeController
 * @package App\Http\Controllers\BackendApi\Merchant\Notice
 */
class SystemNoticeController
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
        $inputDatas  = $request->validated();
        $outputDatas = $action->execute($inputDatas);
        return $outputDatas;
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
        $inputDatas  = $request->validated();
        $outputDatas = $action->execute($inputDatas);
        return $outputDatas;
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
        $inputDatas  = $request->validated();
        $outputDatas = $action->execute($inputDatas);
        return $outputDatas;
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
        $inputDatas  = $request->validated();
        $outputDatas = $action->execute($inputDatas);
        return $outputDatas;
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
        $inputDatas  = $request->validated();
        $outputDatas = $action->execute($inputDatas);
        return $outputDatas;
    }
}
