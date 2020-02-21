<?php

namespace App\Http\SingleActions\Backend\Headquarters\DeveloperUsage\Backend\Menu;

use App\Models\DeveloperUsage\Menu\BackendSystemMenu;
use Illuminate\Http\JsonResponse;

/**
 * Class for menu display action.
 */
class DisplayAction
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
        $menuEloq = $this->model->find($inputDatas['id']);
        if (!$menuEloq) {
            throw new \Exception('300004');
        }
        $menuEloq->display = $inputDatas['display'];
        if (!$menuEloq->save()) {
            throw new \Exception('300006');
        }
        $this->model->deleteCache();
        $msgOut = msgOut(['label' => $menuEloq->label]);
        return $msgOut;
    }
}
