<?php

namespace App\Http\SingleActions\Backend\Headquarters\DeveloperUsage\Backend\Menu;

use App\Http\SingleActions\MainAction;
use Illuminate\Http\JsonResponse;

/**
 * Class for menu delete action.
 */
class CurrentAdminMenuAction extends MainAction
{

    /**
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(): JsonResponse
    {
        $data   = $this->menuLists;
        $msgOut = msgOut($data);
        return $msgOut;
    }
}
