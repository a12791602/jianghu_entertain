<?php

namespace App\Http\Controllers\BackendApi\Headquarters\Finance;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Headquarters\Finance\FinanceChannel\AddDoRequest;
use App\Http\Requests\Backend\Headquarters\Finance\FinanceChannel\DelDoRequest;
use App\Http\Requests\Backend\Headquarters\Finance\FinanceChannel\EditDetailRequest;
use App\Http\Requests\Backend\Headquarters\Finance\FinanceChannel\EditDoRequest;
use App\Http\Requests\Backend\Headquarters\Finance\FinanceChannel\IndexDoRequest;
use App\Http\Requests\Backend\Headquarters\Finance\FinanceChannel\OptEditDoRequest;
use App\Http\Requests\Backend\Headquarters\Finance\FinanceChannel\StatusDoRequest;
use App\Http\SingleActions\Backend\Headquarters\Finance\FinanceChannel\AddDoAction;
use App\Http\SingleActions\Backend\Headquarters\Finance\FinanceChannel\DelDoAction;
use App\Http\SingleActions\Backend\Headquarters\Finance\FinanceChannel\EditDetailAction;
use App\Http\SingleActions\Backend\Headquarters\Finance\FinanceChannel\EditDoAction;
use App\Http\SingleActions\Backend\Headquarters\Finance\FinanceChannel\GetSearchConditionAction;
use App\Http\SingleActions\Backend\Headquarters\Finance\FinanceChannel\IndexDoAction;
use App\Http\SingleActions\Backend\Headquarters\Finance\FinanceChannel\OptEditDoAction;
use App\Http\SingleActions\Backend\Headquarters\Finance\FinanceChannel\StatusDoAction;
use Illuminate\Http\JsonResponse;

/**
 * 金流通道控制器
 * Class BackendFinanceChannelController
 *
 * @package App\Http\Controllers\BackendApi\Headquarters\Finance
 */
class BackendFinanceChannelController extends Controller
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
        return $action->execute($inputDatas);
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
        return $action->execute($inputDatas);
    }

    /**
     * 金流通道-编辑详情
     *
     * @param  EditDetailAction  $action  Action.
     * @param  EditDetailRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function editDetail(
        EditDetailAction $action,
        EditDetailRequest $request
    ): JsonResponse {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
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
        return $action->execute($inputDatas);
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
        return $action->execute($inputDatas);
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
        return $action->execute($inputDatas);
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
        return $action->execute();
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
        return $action->execute($inputDatas);
    }
}
