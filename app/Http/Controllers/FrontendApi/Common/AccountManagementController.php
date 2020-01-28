<?php

namespace App\Http\Controllers\FrontendApi\Common;

use App\Http\Controllers\FrontendApi\FrontendApiMainController;
use App\Http\Requests\Frontend\Common\FrontendUser\AccountDestroyRequest;
use App\Http\Requests\Frontend\Common\FrontendUser\AliPaySaveRequest;
use App\Http\Requests\Frontend\Common\FrontendUser\BankCardSaveRequest;
use App\Http\SingleActions\Frontend\Common\AccountManagement\AccountDestroyAction;
use App\Http\SingleActions\Frontend\Common\AccountManagement\AccountListAction;
use App\Http\SingleActions\Frontend\Common\AccountManagement\AliPaySaveAction;
use App\Http\SingleActions\Frontend\Common\AccountManagement\BankCardSaveAction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class AccountManagementController
 * @package App\Http\Controllers\FrontendApi\Common
 */
class AccountManagementController extends FrontendApiMainController
{

    /**
     * User account List.
     * @param AccountListAction $action  User account list action.
     * @param Request           $request Request.
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception Exception.
     */
    public function accountList(AccountListAction $action, Request $request): JsonResponse
    {
        $result = $action->execute($request);
        return $result;
    }

    /**
     * Save bank card.
     * @param BankCardSaveAction  $action  BankCardSaveAction.
     * @param BankCardSaveRequest $request BankCardAddRequest.
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception Exception.
     */
    public function bankCardSave(
        BankCardSaveAction $action,
        BankCardSaveRequest $request
    ): JsonResponse {
        $result = $action->execute($this, $request);
        return $result;
    }

    /**
     *  Save AliPay.
     * @param AliPaySaveAction  $action  AliPaySaveAction.
     * @param AliPaySaveRequest $request AliPayAddRequest.
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception Exception.
     */
    public function aliPaySave(AliPaySaveAction $action, AliPaySaveRequest $request): JsonResponse
    {
        $result = $action->execute($this, $request);
        return $result;
    }

    /**
     *  Destroy account.
     * @param AccountDestroyAction  $action  AccountDestroyAction.
     * @param AccountDestroyRequest $request AccountDestroyRequest.
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception Exception.
     */
    public function accountDestroy(
        AccountDestroyAction $action,
        AccountDestroyRequest $request
    ): JsonResponse {
        $result = $action->execute($request);
        return $result;
    }
}
