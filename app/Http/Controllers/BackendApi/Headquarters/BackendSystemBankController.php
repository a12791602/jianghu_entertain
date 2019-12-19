<?php

namespace App\Http\Controllers\BackendApi\Headquarters;

use App\Http\Controllers\BackendApi\BackEndApiMainController;
use App\Http\Requests\Backend\Headquarters\SystemBank\AddDoRequest;
use App\Http\Requests\Backend\Headquarters\SystemBank\DelDoRequest;
use App\Http\Requests\Backend\Headquarters\SystemBank\EditRequest;
use App\Http\Requests\Backend\Headquarters\SystemBank\IndexRequest;
use App\Http\Requests\Backend\Headquarters\SystemBank\StatusRequest;
use App\Http\SingleActions\Backend\Headquarters\SystemBank\AddDoAction;
use App\Http\SingleActions\Backend\Headquarters\SystemBank\DelDoAction;
use App\Http\SingleActions\Backend\Headquarters\SystemBank\EditAction;
use App\Http\SingleActions\Backend\Headquarters\SystemBank\IndexAction;
use App\Http\SingleActions\Backend\Headquarters\SystemBank\StatusAction;
use Illuminate\Http\JsonResponse;

/**
 * 系统银行控制器
 * Class BackendSystemBankController
 *
 * @package App\Http\Controllers\BackendApi\Headquarters
 */
class BackendSystemBankController extends BackEndApiMainController
{
    /**
     * 系统银行添加
     *
     * @param  AddDoAction  $action  Action.
     * @param  AddDoRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function addDo(
        AddDoAction $action,
        AddDoRequest $request
    ): JsonResponse {
        $inputDatas = $request->validated();
        $msgOut     = $action->execute($this, $inputDatas);
        return $msgOut;
    }

    /**
     * 系统银行卡列表
     *
     * @param  IndexAction  $action  Action.
     * @param  IndexRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function index(
        IndexAction $action,
        IndexRequest $request
    ): JsonResponse {
        $inputDatas = $request->validated();
        $msgOut     = $action->execute($inputDatas);
        return $msgOut;
    }

    /**
     * 编辑银行卡
     *
     * @param  EditAction  $action  Action.
     * @param  EditRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function edit(
        EditAction $action,
        EditRequest $request
    ): JsonResponse {
        $inputDatas = $request->validated();
        $msgOut     = $action->execute($this, $inputDatas);
        return $msgOut;
    }

    /**
     * @param  DelDoAction  $action  Action.
     * @param  DelDoRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function delDo(
        DelDoAction $action,
        DelDoRequest $request
    ): JsonResponse {
        $inputDatas = $request->validated();
        $msgOut     = $action->execute($inputDatas);
        return $msgOut;
    }

    /**
     * @param  StatusAction  $action  Action.
     * @param  StatusRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function status(
        StatusAction $action,
        StatusRequest $request
    ): JsonResponse {
        $inputDatas = $request->validated();
        $msgOut     = $action->execute($this, $inputDatas);
        return $msgOut;
    }
}
