<?php

namespace App\Http\SingleActions\Backend\Headquarters\DeveloperUsage\Backend\Menu;

use App\Models\DeveloperUsage\Menu\BackendSystemMenu;
use Illuminate\Http\JsonResponse;

/**
 * Class for menu change parent action.
 */
class ChangeParentAction
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
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $menuLabel = $this->model::changeParent($inputDatas);
        $msgOut    = msgOut(['label' => $menuLabel]);
        return $msgOut;
    }
}
