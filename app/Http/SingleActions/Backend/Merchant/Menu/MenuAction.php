<?php

namespace App\Http\SingleActions\Backend\Merchant\Menu;

use App\Http\SingleActions\MainAction;
use Illuminate\Http\JsonResponse;

/**
 * Class MenuAction
 * @package App\Http\SingleActions\Backend\Merchant\Menu
 */
class MenuAction extends MainAction
{
    /**
     * 菜单
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(): JsonResponse
    {
        $result = msgOut($this->menuLists);
        return $result;
    }
}
