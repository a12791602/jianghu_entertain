<?php

namespace App\Http\Controllers\BackendApi\Headquarters;

use App\Http\Requests\Backend\Headquarters\FinanceChannel\AddDoRequest;
use App\Http\Requests\Backend\Headquarters\FinanceChannel\DelDoRequest;
use App\Http\Requests\Backend\Headquarters\FinanceChannel\EditDoRequest;
use App\Http\Requests\Backend\Headquarters\FinanceChannel\IndexDoRequest;
use App\Http\Requests\Backend\Headquarters\FinanceChannel\OptEditDoRequest;
use App\Http\Requests\Backend\Headquarters\FinanceChannel\StatusDoRequest;
use App\Http\SingleActions\Backend\Headquarters\FinanceChannel\AddDoAction;
use App\Http\SingleActions\Backend\Headquarters\FinanceChannel\DelDoAction;
use App\Http\SingleActions\Backend\Headquarters\FinanceChannel\EditDoAction;
use App\Http\SingleActions\Backend\Headquarters\FinanceChannel\GetSearchConditionAction;
use App\Http\SingleActions\Backend\Headquarters\FinanceChannel\IndexDoAction;
use App\Http\SingleActions\Backend\Headquarters\FinanceChannel\OptEditDoAction;
use App\Http\SingleActions\Backend\Headquarters\FinanceChannel\StatusDoAction;
use Illuminate\Http\JsonResponse;

/**
 * 金流通道控制器
 * Class BackendFinanceChannelController
 *
 * @package App\Http\Controllers\BackendApi\Headquarters
 */
class BackendFinanceChannelController
{
    /**
     * 金流通道添加
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
     * 开发 编辑金流通道
     *
     * @param  EditDoAction  $action  Action.
     * @param  EditDoRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function editDo(
        EditDoAction $action,
        EditDoRequest $request
    ): JsonResponse {
        $inputDatas = $request->validated();
        $msgOut     = $action->execute($inputDatas);
        return $msgOut;
    }

    /**
     * 运营 编辑金流通道
     *
     * @param  OptEditDoAction  $action  Action.
     * @param  OptEditDoRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function optEditDo(
        OptEditDoAction $action,
        OptEditDoRequest $request
    ): JsonResponse {
        $inputDatas = $request->validated();
        $msgOut     = $action->execute($inputDatas);
        return $msgOut;
    }
    /**
     * 金流通道列表
     *
     * @param  IndexDoAction  $action  Action.
     * @param  IndexDoRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function indexDo(
        IndexDoAction $action,
        IndexDoRequest $request
    ): JsonResponse {
        $inputDatas = $request->validated();
        $msgOut     = $action->execute($inputDatas);
        return $msgOut;
    }

    /**
     * 金流通道删除
     *
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
     * 获取查询条件
     *
     * @param  GetSearchConditionAction $action Action.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function getSearchCondition(GetSearchConditionAction $action): JsonResponse
    {
        $msgOut = $action->execute();
        return $msgOut;
    }

    /**
     * 改变金流通道的状态
     *
     * @param  StatusDoAction  $action  Action.
     * @param  StatusDoRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function statusDo(
        StatusDoAction $action,
        StatusDoRequest $request
    ): JsonResponse {
        $inputDatas = $request->validated();
        $msgOut     = $action->execute($inputDatas);
        return $msgOut;
    }
}
