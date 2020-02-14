<?php

namespace App\Http\Controllers\FrontendApi\Common;

use App\Http\Requests\Frontend\Common\FrontendUser\AccountDestroyRequest;
use App\Http\Requests\Frontend\Common\FrontendUser\AliPayBindingRequest;
use App\Http\Requests\Frontend\Common\FrontendUser\AliPayFirstBindingRequest;
use App\Http\Requests\Frontend\Common\FrontendUser\BankCardBindingRequest;
use App\Http\Requests\Frontend\Common\FrontendUser\BankCardFirstBindingRequest;
use App\Http\SingleActions\Frontend\Common\AccountManagement\AccountDestroyAction;
use App\Http\SingleActions\Frontend\Common\AccountManagement\AccountListAction;
use App\Http\SingleActions\Frontend\Common\AccountManagement\AliPayBindingAction;
use App\Http\SingleActions\Frontend\Common\AccountManagement\BankCardBindingAction;
use App\Http\SingleActions\Frontend\Common\AccountManagement\FundPasswordCheckAction;
use Illuminate\Http\JsonResponse;

/**
 * Class AccountManagementController
 * @package App\Http\Controllers\FrontendApi\Common
 */
class AccountManagementController
{

    /**
     * User account List.
     * @param AccountListAction $action User account list action.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function accountList(AccountListAction $action): JsonResponse
    {
        $result = $action->execute();
        return $result;
    }

    /**
     * Binding bank card.
     * @param BankCardBindingAction  $action  BankCardBindingAction.
     * @param BankCardBindingRequest $request BankCardAddRequest.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function bankCardBinding(
        BankCardBindingAction $action,
        BankCardBindingRequest $request
    ): JsonResponse {
        $result = $action->execute($request);
        return $result;
    }

    /**
     * Binding bank card.
     * @param BankCardBindingAction       $action  BankCardBindingAction.
     * @param BankCardFirstBindingRequest $request BankCardFirstBindingRequest.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function bankCardFirstBinding(
        BankCardBindingAction $action,
        BankCardFirstBindingRequest $request
    ): JsonResponse {
        $result = $action->firstExecute($request);
        return $result;
    }

    /**
     *  Binding AliPay.
     * @param AliPayBindingAction  $action  AliPayBindingAction.
     * @param AliPayBindingRequest $request AliPayAddRequest.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function aliPayBinding(
        AliPayBindingAction $action,
        AliPayBindingRequest $request
    ): JsonResponse {
        $result = $action->execute($request);
        return $result;
    }

    /**
     *  First binding AliPay.
     * @param AliPayBindingAction       $action  AliPayBindingAction.
     * @param AliPayFirstBindingRequest $request AliPayFirstBindingRequest.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function aliPayFirstBinding(
        AliPayBindingAction $action,
        AliPayFirstBindingRequest $request
    ): JsonResponse {
        $result = $action->firstExecute($request);
        return $result;
    }

    /**
     *  Destroy account.
     * @param AccountDestroyAction  $action  AccountDestroyAction.
     * @param AccountDestroyRequest $request AccountDestroyRequest.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function accountDestroy(
        AccountDestroyAction $action,
        AccountDestroyRequest $request
    ): JsonResponse {
        $result = $action->execute($request);
        return $result;
    }

    /**
     * @param FundPasswordCheckAction $action FundPasswordCheckAction.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function fundPasswordCheck(FundPasswordCheckAction $action): JsonResponse
    {
        $result = $action->execute();
        return $result;
    }
}
