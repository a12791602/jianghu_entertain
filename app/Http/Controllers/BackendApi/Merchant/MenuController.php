<?php

namespace App\Http\Controllers\BackendApi\Merchant;

use App\Http\Controllers\Controller;
use App\Http\SingleActions\Backend\Merchant\Menu\MenuAction;
use Illuminate\Http\JsonResponse;

/**
 * 菜单
 */
class MenuController extends Controller
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
