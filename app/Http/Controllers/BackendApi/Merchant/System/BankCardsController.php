<?php

namespace App\Http\Controllers\BackendApi\Merchant\System;

use App\Http\Requests\Backend\Merchant\System\BankCards\DeleteRequest;
use App\Http\Requests\Backend\Merchant\System\BankCards\IndexRequest;
use App\Http\SingleActions\Backend\Merchant\System\BankCards\DeleteAction;
use App\Http\SingleActions\Backend\Merchant\System\BankCards\IndexAction;
use Illuminate\Http\JsonResponse;

/**
 * 银行卡反查
 */
class BankCardsController
{

    /**
     * 用户银行卡-列表
     *
     * @param  IndexRequest $request Request.
     * @param  IndexAction  $action  Action.
     * @return JsonResponse
     */
    public function index(IndexRequest $request, IndexAction $action): JsonResponse
    {
        $inputDatas = $request->validated();
        $msgOut     = $action->execute($inputDatas);
        return $msgOut;
    }

    /**
     * 用户银行卡-删除
     *
     * @param  DeleteRequest $request Request.
     * @param  DeleteAction  $action  Action.
     * @return JsonResponse
     */
    public function delete(DeleteRequest $request, DeleteAction $action): JsonResponse
    {
        $inputDatas = $request->validated();
        $msgOut     = $action->execute($inputDatas);
        return $msgOut;
    }
}
