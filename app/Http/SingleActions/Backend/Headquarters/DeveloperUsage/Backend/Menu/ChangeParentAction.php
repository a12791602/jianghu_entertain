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
        $parseDatas  = json_decode($inputDatas['dragResult'], true);
        $itemProcess = [];
        if (!empty($parseDatas)) {
            $itemProcess = $this->model->changeParent($parseDatas);
            $msgOut      = msgOut($itemProcess);
            return $msgOut;
        }
        throw new \Exception('300001');
    }
}
