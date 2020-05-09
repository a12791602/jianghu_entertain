<?php

namespace App\Http\Controllers\BackendApi\Merchant\Finance;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Merchant\Finance\UserAccount\IndexRequest;
use App\Http\SingleActions\Backend\Merchant\Finance\UserAccount\AccountTypeAction;
use App\Http\SingleActions\Backend\Merchant\Finance\UserAccount\IndexAction;
use Illuminate\Http\JsonResponse;

/**
 * Class UserAccountController
 * @package App\Http\Controllers\BackendApi\Merchant\Finance
 */
class UserAccountController extends Controller
{

    /**
     * 资金账变-列表
     * @param  IndexAction  $action  Action.
     * @param  IndexRequest $request Request.
     * @return JsonResponse
     */
    public function index(
        IndexAction $action,
        IndexRequest $request
    ): JsonResponse {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * 资金账变-账变类型列表
     * @param  AccountTypeAction $action Action.
     * @return JsonResponse
     */
    public function accountType(AccountTypeAction $action): JsonResponse
    {
        return $action->execute();
    }
}
