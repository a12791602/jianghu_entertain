<?php

namespace App\Http\Controllers\BackendApi\Headquarters\DeveloperUsage\Merchant;

use App\Http\Controllers\BackendApi\Headquarters\BackEndApiMainController;
use App\Http\Requests\Backend\Headquarters\DeveloperUsage\Merchant\Menu\DoAddRequest;
use App\Http\Requests\Backend\Headquarters\DeveloperUsage\Merchant\Menu\DeleteRequest;
use App\Http\Requests\Backend\Headquarters\DeveloperUsage\Merchant\Menu\EditRequest;
use App\Http\SingleActions\Backend\Headquarters\DeveloperUsage\Merchant\Menu\DoAddAction;
use App\Http\SingleActions\Backend\Headquarters\DeveloperUsage\Merchant\Menu\ChangeParentAction;
use App\Http\SingleActions\Backend\Headquarters\DeveloperUsage\Merchant\Menu\DeleteAction;
use App\Http\SingleActions\Backend\Headquarters\DeveloperUsage\Merchant\Menu\EditAction;
use App\Http\SingleActions\Backend\Headquarters\DeveloperUsage\Merchant\Menu\GetAllMenuAction;
use Illuminate\Http\JsonResponse;

/**
 * 菜单
 */
class MenuController extends BackEndApiMainController
{
    /**
     * Gets all menu.
     *
     * @param  GetAllMenuAction $action Action.
     * @return JsonResponse
     */
    public function getAllMenu(GetAllMenuAction $action)
    {
        return $action->execute();
    }

    /**
     * @param  DoAddRequest $request Request.
     * @param  DoAddAction  $action  Action.
     * @return JsonResponse
     */
    public function doAdd(DoAddRequest $request, DoAddAction $action): JsonResponse
    {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * @param  DeleteRequest $request Request.
     * @param  DeleteAction  $action  Action.
     * @return JsonResponse
     */
    public function delete(DeleteRequest $request, DeleteAction $action): JsonResponse
    {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     *  菜单编辑接口
     * (?!\.) - don't allow . at start
     * (?!.*?\.\.) - don't allow 2 consecutive dots
     * (?!.*\.$) - don't allow . at end
     *
     * @param  EditRequest $request Request.
     * @param  EditAction  $action  Action.
     * @return JsonResponse
     */
    public function edit(EditRequest $request, EditAction $action): JsonResponse
    {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * @param  ChangeParentAction $action Action.
     * @return JsonResponse
     */
    public function changeParent(ChangeParentAction $action): JsonResponse
    {
        return $action->execute($this->inputs);
    }
}
