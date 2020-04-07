<?php

namespace App\Http\Controllers\BackendApi\Merchant\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Merchant\User\FrontendUser\AlipayDestroyRequest;
use App\Http\Requests\Backend\Merchant\User\FrontendUser\BlackRequest;
use App\Http\Requests\Backend\Merchant\User\FrontendUser\DetailRequest;
use App\Http\Requests\Backend\Merchant\User\FrontendUser\IndexRequest;
use App\Http\Requests\Backend\Merchant\User\FrontendUser\LabelRequest;
use App\Http\Requests\Backend\Merchant\User\FrontendUser\LoginLogRequest;
use App\Http\Requests\Backend\Merchant\User\FrontendUser\ResetPasswordRequest;
use App\Http\Requests\Backend\Merchant\User\FrontendUser\StoreRequest;
use App\Http\Requests\Backend\Merchant\User\FrontendUser\UnlockRequest;
use App\Http\Requests\Backend\Merchant\User\FrontendUser\WithdrawalsPasswordRequest;
use App\Http\SingleActions\Backend\Merchant\User\FrontendUser\AlipayDestroyAction;
use App\Http\SingleActions\Backend\Merchant\User\FrontendUser\BlackAction;
use App\Http\SingleActions\Backend\Merchant\User\FrontendUser\DetailAction;
use App\Http\SingleActions\Backend\Merchant\User\FrontendUser\IndexAction;
use App\Http\SingleActions\Backend\Merchant\User\FrontendUser\LabelAction;
use App\Http\SingleActions\Backend\Merchant\User\FrontendUser\LoginLogAction;
use App\Http\SingleActions\Backend\Merchant\User\FrontendUser\ResetPasswordAction;
use App\Http\SingleActions\Backend\Merchant\User\FrontendUser\StoreAction;
use App\Http\SingleActions\Backend\Merchant\User\FrontendUser\UnlockAction;
use App\Http\SingleActions\Backend\Merchant\User\FrontendUser\WithdrawalsPasswordAction;
use Illuminate\Http\JsonResponse;

/**
 * 用户相关
 */
class FrontendUserController extends Controller
{

    /**
     * 会员列表
     * @param IndexRequest $request Request.
     * @param IndexAction  $action  Action.
     * @return JsonResponse
     * @throws \RuntimeException Exception.
     */
    public function index(IndexRequest $request, IndexAction $action): JsonResponse
    {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * 会员添加
     * @param StoreAction  $action  DetailAction.
     * @param StoreRequest $request DetailRequest.
     * @return JsonResponse
     * @throws \RuntimeException Exception.
     */
    public function store(StoreAction $action, StoreRequest $request): JsonResponse
    {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * 会员详情
     * @param DetailAction  $action  DetailAction.
     * @param DetailRequest $request DetailRequest.
     * @return JsonResponse
     * @throws \RuntimeException Exception.
     */
    public function detail(DetailAction $action, DetailRequest $request): JsonResponse
    {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * 加入黑名单
     * @param BlackRequest $request BlackRequest.
     * @param BlackAction  $action  BlackAction.
     * @return JsonResponse
     */
    public function black(BlackRequest $request, BlackAction $action): JsonResponse
    {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * 修改会员标签
     * @param LabelAction  $action  DetailAction.
     * @param LabelRequest $request DetailRequest.
     * @return JsonResponse
     */
    public function label(LabelAction $action, LabelRequest $request): JsonResponse
    {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * 会员重置密码
     * @param ResetPasswordAction  $action  DetailAction.
     * @param ResetPasswordRequest $request DetailRequest.
     * @return JsonResponse
     * @throws \RuntimeException Exception.
     */
    public function password(
        ResetPasswordAction $action,
        ResetPasswordRequest $request
    ): JsonResponse {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * 会员重置取款密码
     * @param WithdrawalsPasswordAction  $action  WithdrawalsPasswordAction.
     * @param WithdrawalsPasswordRequest $request WithdrawalsPasswordRequest.
     * @return JsonResponse
     * @throws \RuntimeException Exception.
     */
    public function withdrawalsPassword(
        WithdrawalsPasswordAction $action,
        WithdrawalsPasswordRequest $request
    ): JsonResponse {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * 会员清空支付宝
     * @param AlipayDestroyAction  $action  AlipayDestroyAction.
     * @param AlipayDestroyRequest $request AlipayDestroyRequest.
     * @return JsonResponse
     * @throws \RuntimeException Exception.
     */
    public function alipayDestroy(
        AlipayDestroyAction $action,
        AlipayDestroyRequest $request
    ): JsonResponse {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * 会员解锁
     * @param UnlockAction  $action  UnlockAction.
     * @param UnlockRequest $request UnlockRequest.
     * @return JsonResponse
     * @throws \RuntimeException Exception.
     */
    public function unlock(
        UnlockAction $action,
        UnlockRequest $request
    ): JsonResponse {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * 会员登录记录
     * @param LoginLogRequest $request Request.
     * @param LoginLogAction  $action  Action.
     * @return JsonResponse
     * @throws \RuntimeException Exception.
     */
    public function loginLog(LoginLogRequest $request, LoginLogAction $action): JsonResponse
    {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }
}
