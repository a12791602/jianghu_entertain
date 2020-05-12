<?php

namespace App\Http\Controllers\BackendApi\Headquarters\Game;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Headquarters\Game\Game\AddDoRequest;
use App\Http\Requests\Backend\Headquarters\Game\Game\DelDoRequest;
use App\Http\Requests\Backend\Headquarters\Game\Game\EditDetailRequest;
use App\Http\Requests\Backend\Headquarters\Game\Game\EditDoRequest;
use App\Http\Requests\Backend\Headquarters\Game\Game\IconRequest;
use App\Http\Requests\Backend\Headquarters\Game\Game\IndexDoRequest;
use App\Http\Requests\Backend\Headquarters\Game\Game\OptEditDoRequest;
use App\Http\Requests\Backend\Headquarters\Game\Game\StatusDoRequest;
use App\Http\SingleActions\Backend\Headquarters\Game\Game\AddDoAction;
use App\Http\SingleActions\Backend\Headquarters\Game\Game\DelDoAction;
use App\Http\SingleActions\Backend\Headquarters\Game\Game\EditDetailAction;
use App\Http\SingleActions\Backend\Headquarters\Game\Game\EditDoAction;
use App\Http\SingleActions\Backend\Headquarters\Game\Game\GetSearchConditionAction;
use App\Http\SingleActions\Backend\Headquarters\Game\Game\IconAction;
use App\Http\SingleActions\Backend\Headquarters\Game\Game\IndexDoAction;
use App\Http\SingleActions\Backend\Headquarters\Game\Game\OptEditDoAction;
use App\Http\SingleActions\Backend\Headquarters\Game\Game\StatusDoAction;
use Illuminate\Http\JsonResponse;

/**
 * 游戏控制器
 * Class BackendGameController
 *
 * @package App\Http\Controllers\BackendApi\Headquarters
 */
class BackendGameController extends Controller
{
    /**
     * 添加游戏
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
     * 开发 编辑游戏
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
     * 游戏编辑详情
     *
     * @param  EditDetailRequest $request Request.
     * @param  EditDetailAction  $action  Action.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function editDetail(
        EditDetailRequest $request,
        EditDetailAction $action
    ): JsonResponse {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * 运营 编辑游戏
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
     * 游戏列表
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
     * 游戏删除
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
     * 改变状态
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

    /**
     * 更新游戏图标
     *
     * @param IconAction  $action  Action.
     * @param IconRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function icon(
        IconAction $action,
        IconRequest $request
    ): JsonResponse {
        $inputData = $request->validated();
        return $action->execute($inputData);
    }
}
