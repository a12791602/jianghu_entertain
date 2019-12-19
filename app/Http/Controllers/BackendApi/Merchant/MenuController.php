<?php

namespace App\Http\Controllers\BackendApi\Merchant;

use App\Http\Controllers\BackendApi\BackEndApiMainController;
use Illuminate\Http\JsonResponse;

/**
 * 菜单
 */
class MenuController extends BackEndApiMainController
{
    /**
     * @return JsonResponse
     */
    public function currentAdminMenu(): JsonResponse
    {
        $msgOut = msgOut(true, $this->menuLists);
        return $msgOut;
    }
}
