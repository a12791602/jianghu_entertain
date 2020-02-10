<?php

namespace App\Http\SingleActions\Backend\Headquarters\DeveloperUsage\Backend\Menu;

use App\Models\DeveloperUsage\Menu\BackendSystemMenu;
use Illuminate\Http\JsonResponse;

/**
 * Class for menu do add action.
 */
class DoAddAction
{

    /**
     * @var BackendSystemMenu
     */
    protected $model;

    /**
     * @param BackendSystemMenu $backendSystemMenu Model.
     */
    public function __construct(BackendSystemMenu $backendSystemMenu)
    {
        $this->model = $backendSystemMenu;
    }

    /**
     * @param  array $inputDatas 传递的参数.
     * @return JsonResponse
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $parent = false;
        if (isset($inputDatas['is_parent']) && (int) $inputDatas['is_parent'] === 1) {
            $parent = true;
        }
        $menuEloq          = new BackendSystemMenu();
        $menuEloq->label   = $inputDatas['label'];
        $menuEloq->en_name = $inputDatas['en_name'];
        $menuEloq->route   = $inputDatas['route'];
        $menuEloq->display = $inputDatas['display'];
        $menuEloq->icon    = $inputDatas['icon'] ?? null;
        $menuEloq->sort    = $inputDatas['sort'];
        if ($parent === false) {
            $menuEloq->pid   = $inputDatas['parent_id'];
            $menuEloq->level = $inputDatas['level'];
        }
        $menuEloq->save();
        $msgOut = msgOut(['label' => $menuEloq->label]);
        return $msgOut;
    }
}
