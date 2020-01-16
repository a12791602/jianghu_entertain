<?php

namespace App\Http\SingleActions\Backend\Headquarters\DeveloperUsage\Merchant\Menu;

use App\Models\DeveloperUsage\Menu\MerchantSystemMenu;
use Illuminate\Http\JsonResponse;

/**
 * Class for menu do add action.
 */
class DoAddAction
{

    /**
     * @var MerchantSystemMenu
     */
    protected $model;

    /**
     * @param MerchantSystemMenu $merchantSystemMenu Model.
     */
    public function __construct(MerchantSystemMenu $merchantSystemMenu)
    {
        $this->model = $merchantSystemMenu;
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
        $menuEloq          = $this->model;
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
        $msgOut = msgOut($menuEloq->toArray());
        return $msgOut;
    }
}
