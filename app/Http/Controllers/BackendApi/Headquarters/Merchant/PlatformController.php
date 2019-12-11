<?php

namespace App\Http\Controllers\BackendApi\Headquarters\Merchant;

use App\Http\Controllers\BackendApi\Headquarters\BackEndApiMainController;
use App\Http\Requests\Backend\Headquarters\Merchant\Platform\AssignedGameCancelRequest;
use App\Http\Requests\Backend\Headquarters\Merchant\Platform\AssignedGamesRequest;
use App\Http\Requests\Backend\Headquarters\Merchant\Platform\AssignGamesRequest;
use App\Http\Requests\Backend\Headquarters\Merchant\Platform\DoAddRequest;
use App\Http\Requests\Backend\Headquarters\Merchant\Platform\SwitchRequest;
use App\Http\Requests\Backend\Headquarters\Merchant\Platform\DomainDetailRequest;
use App\Http\Requests\Backend\Headquarters\Merchant\Platform\DomainAddRequest;
use App\Http\Requests\Backend\Headquarters\Merchant\Platform\UnassignGamesRequest;
use App\Http\SingleActions\Backend\Headquarters\Merchant\Platform\AssignedGameCancelAction;
use App\Http\SingleActions\Backend\Headquarters\Merchant\Platform\AssignedGamesAction;
use App\Http\SingleActions\Backend\Headquarters\Merchant\Platform\AssignGamesAction;
use App\Http\SingleActions\Backend\Headquarters\Merchant\Platform\DetailAction;
use App\Http\SingleActions\Backend\Headquarters\Merchant\Platform\DoAddAction;
use App\Http\SingleActions\Backend\Headquarters\Merchant\Platform\GetSearchDataOfAssignGameAction;
use App\Http\SingleActions\Backend\Headquarters\Merchant\Platform\SwitchAction;
use App\Http\SingleActions\Backend\Headquarters\Merchant\Platform\DomainDetailAction;
use App\Http\SingleActions\Backend\Headquarters\Merchant\Platform\DomainAddAction;
use App\Http\SingleActions\Backend\Headquarters\Merchant\Platform\UnassignGamesAction;
use Illuminate\Http\JsonResponse;

/**
 * 运营商
 */
class PlatformController extends BackEndApiMainController
{
    /**
     *
     * 运营商平台列表
     * @param DetailAction $action Action.
     * @return JsonResponse
     */
    public function detail(DetailAction $action): JsonResponse
    {
        return $action->execute();
    }

    /**
     * 添加运营商平台
     * @param DoAddRequest $request Request.
     * @param DoAddAction  $action  Action.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function doAdd(DoAddRequest $request, DoAddAction $action): JsonResponse
    {
        $inputDatas = $request->validated();
        return $action->execute($this, $inputDatas);
    }


    /**
     * 运营商平台开关
     * @param SwitchRequest $request Request.
     * @param SwitchAction  $action  Action.
     * @return JsonResponse
     * @throws \Exception Exceotion.
     */
    public function switch(SwitchRequest $request, SwitchAction $action): JsonResponse
    {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * 运营商域名列表
     * @param DomainDetailRequest $request Request.
     * @param DomainDetailAction  $action  Action.
     * @return JsonResponse
     */
    public function domainDetail(DomainDetailRequest $request, DomainDetailAction $action): JsonResponse
    {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * 添加运营商域名
     * @param DomainAddRequest $request Request.
     * @param DomainAddAction  $action  Action.
     * @return JsonResponse
     */
    public function domainAdd(DomainAddRequest $request, DomainAddAction $action): JsonResponse
    {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * 为运营商分配游戏
     * @param AssignGamesAction  $action  Action.
     * @param AssignGamesRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function assignGames(AssignGamesAction $action, AssignGamesRequest $request) :JsonResponse
    {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * 已分配给运营商的游戏
     * @param AssignedGamesAction  $action  Action.
     * @param AssignedGamesRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function assignedGames(AssignedGamesAction $action, AssignedGamesRequest $request):JsonResponse
    {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * 未分配给运营商的游戏列表
     * @param UnassignGamesAction  $action  Action.
     * @param UnassignGamesRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function unassignGames(UnassignGamesAction $action, UnassignGamesRequest $request) :JsonResponse
    {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * 获取分配游戏的查询条件
     * @param GetSearchDataOfAssignGameAction $action Action.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function getSearchDataOfAssignGame(GetSearchDataOfAssignGameAction $action):JsonResponse
    {
        return $action->execute();
    }

    /**
     * 取消已分配的游戏
     * @param AssignedGameCancelAction  $action  Action.
     * @param AssignedGameCancelRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function assignedGameCancel(AssignedGameCancelAction $action, AssignedGameCancelRequest $request):JsonResponse
    {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }
}
