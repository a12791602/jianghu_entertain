<?php

namespace App\Http\SingleActions\Backend\Headquarters\DeveloperUsage\Backend\Menu;

use App\Models\DeveloperUsage\Menu\BackendSystemMenu;
use Illuminate\Http\JsonResponse;

/**
 * Class for menu edit action.
 */
class EditAction
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
        $menuEloq = $this->model::find($inputDatas['id']);
        if (!$menuEloq) {
            throw new \Exception('300004');
        }
        $menuEloq->fill($inputDatas);
        if (!$menuEloq->save()) {
            throw new \Exception('300000');
        }
        $msgOut = msgOut(['label' => $menuEloq->label]);
        return $msgOut;
    }
}
