<?php

namespace App\Http\SingleActions\Backend\Headquarters\DeveloperUsage\Backend\Menu;

use App\Http\SingleActions\MainAction;
use App\Models\DeveloperUsage\Menu\BackendSystemMenu;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class for menu change parent action.
 */
class ChangeParentAction extends MainAction
{

    /**
     * @var BackendSystemMenu
     */
    protected $model;

    /**
     * @param Request           $request           Request.
     * @param BackendSystemMenu $backendSystemMenu Model.
     */
    public function __construct(
        Request $request,
        BackendSystemMenu $backendSystemMenu
    ) {
        parent::__construct($request);
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
        $this->model->deleteCache();
        $msgOut = msgOut(['label' => $menuLabel]);
        return $msgOut;
    }
}
