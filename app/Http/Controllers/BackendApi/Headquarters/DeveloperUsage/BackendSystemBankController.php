<?php

namespace App\Http\Controllers\BackendApi\Headquarters\DeveloperUsage;

use App\Http\Requests\Backend\Headquarters\DeveloperUsage\SystemBank\AddDoRequest;
use App\Http\Requests\Backend\Headquarters\DeveloperUsage\SystemBank\DelDoRequest;
use App\Http\Requests\Backend\Headquarters\DeveloperUsage\SystemBank\EditRequest;
use App\Http\Requests\Backend\Headquarters\DeveloperUsage\SystemBank\IndexRequest;
use App\Http\Requests\Backend\Headquarters\DeveloperUsage\SystemBank\StatusRequest;
use App\Http\SingleActions\Backend\Headquarters\DeveloperUsage\SystemBank\AddDoAction;
use App\Http\SingleActions\Backend\Headquarters\DeveloperUsage\SystemBank\DelDoAction;
use App\Http\SingleActions\Backend\Headquarters\DeveloperUsage\SystemBank\EditAction;
use App\Http\SingleActions\Backend\Headquarters\DeveloperUsage\SystemBank\IndexAction;
use App\Http\SingleActions\Backend\Headquarters\DeveloperUsage\SystemBank\StatusAction;
use Illuminate\Http\JsonResponse;

/**
 * 系统银行控制器
 * Class BackendSystemBankController
 *
 * @package App\Http\Controllers\BackendApi\Headquarters\DeveloperUsage
 */
class BackendSystemBankController
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
        $msgOut     = $action->execute($inputDatas);
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
        $msgOut     = $action->execute($inputDatas);
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
        $msgOut     = $action->execute($inputDatas);
        return $msgOut;
    }
}
