<?php

namespace App\Http\Controllers\BackendApi\Merchant\Notice;

use App\Http\Controllers\BackendApi\BackEndApiMainController;
use App\Http\Requests\Backend\Merchant\Notice\Login\AddDoRequest;
use App\Http\Requests\Backend\Merchant\Notice\Login\DelDoRequest;
use App\Http\Requests\Backend\Merchant\Notice\Login\EditRequest;
use App\Http\Requests\Backend\Merchant\Notice\Login\IndexRequest;
use App\Http\Requests\Backend\Merchant\Notice\Login\StatusRequest;
use App\Http\SingleActions\Backend\Merchant\Notice\Login\AddDoAction;
use App\Http\SingleActions\Backend\Merchant\Notice\Login\DelDoAction;
use App\Http\SingleActions\Backend\Merchant\Notice\Login\EditAction;
use App\Http\SingleActions\Backend\Merchant\Notice\Login\IndexAction;
use App\Http\SingleActions\Backend\Merchant\Notice\Login\StatusAction;
use Illuminate\Http\JsonResponse;

/**
 * Class LoginNoticeController
 * @package App\Http\Controllers\BackendApi\Merchant\Notice
 */
class LoginNoticeController extends BackEndApiMainController
{
    /**
     * 登录弹窗公告添加.
     *
     * @param AddDoAction  $action  Action.
     * @param AddDoRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function addDo(AddDoAction $action, AddDoRequest $request): JsonResponse
    {
        $inputDatas  = $request->validated();
        $outputDatas = $action->execute($this, $inputDatas);
        return $outputDatas;
    }

    /**
     * 编辑登录弹窗公告.
     *
     * @param EditAction  $action  Action.
     * @param EditRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function edit(EditAction $action, EditRequest $request): JsonResponse
    {
        $inputDatas  = $request->validated();
        $outputDatas = $action->execute($this, $inputDatas);
        return $outputDatas;
    }

    /**
     * 登录弹窗公告列表.
     *
     * @param IndexAction  $action  Action.
     * @param IndexRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function index(IndexAction $action, IndexRequest $request): JsonResponse
    {
        $inputDatas  = $request->validated();
        $outputDatas = $action->execute($this, $inputDatas);
        return $outputDatas;
    }

    /**
     * 登录弹窗公告删除.
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
     * 登录弹窗公告改变状态.
     *
     * @param StatusAction  $action  Action.
     * @param StatusRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function status(StatusAction $action, StatusRequest $request): JsonResponse
    {
        $inputDatas  = $request->validated();
        $outputDatas = $action->execute($this, $inputDatas);
        return $outputDatas;
    }
}
