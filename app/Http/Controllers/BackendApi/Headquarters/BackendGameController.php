<?php

namespace App\Http\Controllers\BackendApi\Headquarters;

use App\Http\Requests\Backend\Headquarters\Game\AddRequest;
use App\Http\Requests\Backend\Headquarters\Game\DelRequest;
use App\Http\Requests\Backend\Headquarters\Game\EditRequest;
use App\Http\Requests\Backend\Headquarters\Game\IndexDoRequest;
use App\Http\Requests\Backend\Headquarters\Game\OptEditDoRequest;
use App\Http\Requests\Backend\Headquarters\Game\StatusDoRequest;
use App\Http\SingleActions\Backend\Headquarters\Game\AddDoAction;
use App\Http\SingleActions\Backend\Headquarters\Game\DelDoAction;
use App\Http\SingleActions\Backend\Headquarters\Game\EditDoAction;
use App\Http\SingleActions\Backend\Headquarters\Game\GetSearchConditionAction;
use App\Http\SingleActions\Backend\Headquarters\Game\IndexDoAction;
use App\Http\SingleActions\Backend\Headquarters\Game\OptEditDoAction;
use App\Http\SingleActions\Backend\Headquarters\Game\StatusDoAction;
use Illuminate\Http\JsonResponse;

/**
 * 游戏控制器
 * Class BackendGameController
 *
 * @package App\Http\Controllers\BackendApi\Headquarters
 */
class BackendGameController extends BackEndApiMainController
{
    /**
     * 添加游戏
     *
     * @param  AddDoAction $action  Action.
     * @param  AddRequest  $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function addDo(AddDoAction $action, AddRequest $request) :JsonResponse
    {
        $inputDatas = $request->validated();
        return $action->execute($this, $inputDatas);
    }

    /**
     * 开发 编辑游戏
     *
     * @param  EditDoAction $action  Action.
     * @param  EditRequest  $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function editDo(EditDoAction $action, EditRequest $request) :JsonResponse
    {
        $inputDatas = $request->validated();
        return $action->execute($this, $inputDatas);
    }

    /**
     * 运营 编辑游戏
     *
     * @param  OptEditDoAction  $action  Action.
     * @param  OptEditDoRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function optEditDo(OptEditDoAction $action, OptEditDoRequest $request) :JsonResponse
    {
        $inputDatas = $request->validated();
        return $action->execute($this, $inputDatas);
    }
    /**
     * 游戏列表
     *
     * @param  IndexDoAction  $action  Action.
     * @param  IndexDoRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function indexDo(IndexDoAction $action, IndexDoRequest $request) :JsonResponse
    {
        $inputDatas = $request->validated();
        return $action->execute($this, $inputDatas);
    }

    /**
     * 游戏删除
     *
     * @param  DelDoAction $action  Action.
     * @param  DelRequest  $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function delDo(DelDoAction $action, DelRequest $request) :JsonResponse
    {
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
    public function getSearchCondition(GetSearchConditionAction $action):JsonResponse
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
    public function statusDo(StatusDoAction $action, StatusDoRequest $request):JsonResponse
    {
        $inputDatas = $request->validated();
        return $action->execute($this, $inputDatas);
    }
}
