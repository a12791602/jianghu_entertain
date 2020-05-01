<?php

namespace App\Http\Controllers\BackendApi\Headquarters\Merchant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Headquarters\Merchant\Platform\AssignActivitiesRequest;
use App\Http\Requests\Backend\Headquarters\Merchant\Platform\AssignedActivitiesRequest;
use App\Http\Requests\Backend\Headquarters\Merchant\Platform\AssignedActivityCancelRequest;
use App\Http\Requests\Backend\Headquarters\Merchant\Platform\AssignedGameCancelRequest;
use App\Http\Requests\Backend\Headquarters\Merchant\Platform\AssignedGamesRequest;
use App\Http\Requests\Backend\Headquarters\Merchant\Platform\AssignGamesRequest;
use App\Http\Requests\Backend\Headquarters\Merchant\Platform\DetailRequest;
use App\Http\Requests\Backend\Headquarters\Merchant\Platform\DoAddRequest;
use App\Http\Requests\Backend\Headquarters\Merchant\Platform\DomainAddRequest;
use App\Http\Requests\Backend\Headquarters\Merchant\Platform\DomainDeleteRequest;
use App\Http\Requests\Backend\Headquarters\Merchant\Platform\DomainDetailRequest;
use App\Http\Requests\Backend\Headquarters\Merchant\Platform\DomainStatusRequest;
use App\Http\Requests\Backend\Headquarters\Merchant\Platform\EditRequest;
use App\Http\Requests\Backend\Headquarters\Merchant\Platform\MaintainRequest;
use App\Http\Requests\Backend\Headquarters\Merchant\Platform\SwitchRequest;
use App\Http\Requests\Backend\Headquarters\Merchant\Platform\UnassignActivitiesRequest;
use App\Http\Requests\Backend\Headquarters\Merchant\Platform\UnassignedGamesRequest;
use App\Http\SingleActions\Backend\Headquarters\Merchant\Platform\AssignActivitiesAction;
use App\Http\SingleActions\Backend\Headquarters\Merchant\Platform\AssignedActivitiesAction;
use App\Http\SingleActions\Backend\Headquarters\Merchant\Platform\AssignedActivityCancelAction;
use App\Http\SingleActions\Backend\Headquarters\Merchant\Platform\AssignedGameCancelAction;
use App\Http\SingleActions\Backend\Headquarters\Merchant\Platform\AssignedGamesAction;
use App\Http\SingleActions\Backend\Headquarters\Merchant\Platform\AssignGamesAction;
use App\Http\SingleActions\Backend\Headquarters\Merchant\Platform\DetailAction;
use App\Http\SingleActions\Backend\Headquarters\Merchant\Platform\DoAddAction;
use App\Http\SingleActions\Backend\Headquarters\Merchant\Platform\DomainAddAction;
use App\Http\SingleActions\Backend\Headquarters\Merchant\Platform\DomainDeleteAction;
use App\Http\SingleActions\Backend\Headquarters\Merchant\Platform\DomainDetailAction;
use App\Http\SingleActions\Backend\Headquarters\Merchant\Platform\DomainStatusAction;
use App\Http\SingleActions\Backend\Headquarters\Merchant\Platform\EditAction;
use App\Http\SingleActions\Backend\Headquarters\Merchant\Platform\GetSearchDataOfAssignGameAction;
use App\Http\SingleActions\Backend\Headquarters\Merchant\Platform\MaintainAction;
use App\Http\SingleActions\Backend\Headquarters\Merchant\Platform\SkinListAction;
use App\Http\SingleActions\Backend\Headquarters\Merchant\Platform\SwitchAction;
use App\Http\SingleActions\Backend\Headquarters\Merchant\Platform\UnassignActivitiesAction;
use App\Http\SingleActions\Backend\Headquarters\Merchant\Platform\UnassignedGamesAction;
use Illuminate\Http\JsonResponse;

/**
 * 运营商
 */
class PlatformController extends Controller
{
    /**
     * 运营商平台列表
     *
     * @param  DetailRequest $request Request.
     * @param  DetailAction  $action  Action.
     * @return JsonResponse
     */
    public function detail(DetailRequest $request, DetailAction $action): JsonResponse
    {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * 站点配置
     * @param EditRequest $request Request.
     * @param EditAction  $action  Action.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function edit(EditRequest $request, EditAction $action): JsonResponse
    {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * 添加运营商平台
     *
     * @param  DoAddRequest $request Request.
     * @param  DoAddAction  $action  Action.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function doAdd(DoAddRequest $request, DoAddAction $action): JsonResponse
    {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * 运营商平台开关
     *
     * @param  SwitchRequest $request Request.
     * @param  SwitchAction  $action  Action.
     * @return JsonResponse
     * @throws \Exception Exceotion.
     */
    public function switch(SwitchRequest $request, SwitchAction $action): JsonResponse
    {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * 运营商平台维护
     *
     * @param  MaintainRequest $request Request.
     * @param  MaintainAction  $action  Action.
     * @return JsonResponse
     * @throws \Exception Exceotion.
     */
    public function maintain(MaintainRequest $request, MaintainAction $action): JsonResponse
    {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * 运营商域名列表
     *
     * @param  DomainDetailRequest $request Request.
     * @param  DomainDetailAction  $action  Action.
     * @return JsonResponse
     */
    public function domainDetail(
        DomainDetailRequest $request,
        DomainDetailAction $action
    ): JsonResponse {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * 添加运营商域名
     *
     * @param DomainAddRequest $request Request.
     * @param DomainAddAction  $action  Action.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function domainAdd(DomainAddRequest $request, DomainAddAction $action): JsonResponse
    {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * 运营商域名状态
     *
     * @param DomainStatusRequest $request Request.
     * @param DomainStatusAction  $action  Action.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function domainStatus(
        DomainStatusRequest $request,
        DomainStatusAction $action
    ): JsonResponse {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * 删除运营商域名
     *
     * @param DomainDeleteRequest $request Request.
     * @param DomainDeleteAction  $action  Action.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function domainDelete(
        DomainDeleteRequest $request,
        DomainDeleteAction $action
    ): JsonResponse {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * 为运营商分配游戏
     *
     * @param  AssignGamesAction  $action  Action.
     * @param  AssignGamesRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function assignGames(
        AssignGamesAction $action,
        AssignGamesRequest $request
    ): JsonResponse {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * 已分配给运营商的游戏
     *
     * @param  AssignedGamesAction  $action  Action.
     * @param  AssignedGamesRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function assignedGames(
        AssignedGamesAction $action,
        AssignedGamesRequest $request
    ): JsonResponse {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * 未分配给运营商的游戏列表
     *
     * @param  UnassignedGamesAction  $action  Action.
     * @param  UnassignedGamesRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function unassignedGames(
        UnassignedGamesAction $action,
        UnassignedGamesRequest $request
    ): JsonResponse {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * 获取分配游戏的查询条件
     *
     * @param  GetSearchDataOfAssignGameAction $action Action.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function getSearchDataOfAssignGame(
        GetSearchDataOfAssignGameAction $action
    ): JsonResponse {
        return $action->execute();
    }

    /**
     * 取消已分配的游戏
     *
     * @param  AssignedGameCancelAction  $action  Action.
     * @param  AssignedGameCancelRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function assignedGameCancel(
        AssignedGameCancelAction $action,
        AssignedGameCancelRequest $request
    ): JsonResponse {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * 为运营商分配活动.
     *
     * @param  AssignActivitiesAction  $action  Action.
     * @param  AssignActivitiesRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function assignActivities(
        AssignActivitiesAction $action,
        AssignActivitiesRequest $request
    ): JsonResponse {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * 已分配给运营商的活动
     *
     * @param AssignedActivitiesAction  $action  Action.
     * @param AssignedActivitiesRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function assignedActivities(
        AssignedActivitiesAction $action,
        AssignedActivitiesRequest $request
    ): JsonResponse {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * 未分配给运营商的活动.
     *
     * @param UnassignActivitiesAction  $action  Action.
     * @param UnassignActivitiesRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function unassignActivities(
        UnassignActivitiesAction $action,
        UnassignActivitiesRequest $request
    ): JsonResponse {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * 移除已分配的活动.
     *
     * @param AssignedActivityCancelAction  $action  Action.
     * @param AssignedActivityCancelRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function assignedActivityCancel(
        AssignedActivityCancelAction $action,
        AssignedActivityCancelRequest $request
    ): JsonResponse {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * 运营商皮肤列表
     *
     * @param SkinListAction $action Action.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function skinList(SkinListAction $action): JsonResponse
    {
        return $action->execute();
    }
}
