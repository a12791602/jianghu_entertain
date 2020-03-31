<?php

namespace App\Http\Controllers\BackendApi\Merchant;

use App\Http\SingleActions\Backend\Merchant\Menu\MenuAction;
use Illuminate\Http\JsonResponse;

/**
 * 菜单
 */
class MenuController
{
    /**
     * 菜单
     * @param MenuAction $action 菜单.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function currentAdminMenu(MenuAction $action): JsonResponse
    {
        return $action->execute();
    }
}
