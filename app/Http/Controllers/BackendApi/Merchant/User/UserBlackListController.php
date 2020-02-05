<?php

namespace App\Http\Controllers\BackendApi\Merchant\User;

use App\Http\Requests\Backend\Merchant\User\UserBlackList\DetailRequest;
use App\Http\Requests\Backend\Merchant\User\UserBlackList\IndexRequest;
use App\Http\Requests\Backend\Merchant\User\UserBlackList\RemoveRequest;
use App\Http\SingleActions\Backend\Merchant\User\UserBlackList\DetailAction;
use App\Http\SingleActions\Backend\Merchant\User\UserBlackList\IndexAction;
use App\Http\SingleActions\Backend\Merchant\User\UserBlackList\RemoveAction;
use Illuminate\Http\JsonResponse;

/**
 * 黑名单管理
 */
class UserBlackListController
{
    /**
     * 黑名单列表
     * @param IndexRequest $request Request.
     * @param IndexAction  $action  Action.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function index(IndexRequest $request, IndexAction $action): JsonResponse
    {
        $inputDatas = $request->validated();
        $msgOut     = $action->execute($inputDatas);
        return $msgOut;
    }

    /**
     * @param DetailRequest $request Request.
     * @param DetailAction  $action  Action.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function detail(DetailRequest $request, DetailAction $action): JsonResponse
    {
        $inputDatas = $request->validated();
        $msgOut     = $action->execute($inputDatas);
        return $msgOut;
    }

    /**
     * @param RemoveRequest $request Request.
     * @param RemoveAction  $action  Action.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function remove(RemoveRequest $request, RemoveAction $action): JsonResponse
    {
        $inputDatas = $request->validated();
        $msgOut     = $action->execute($inputDatas);
        return $msgOut;
    }
}
