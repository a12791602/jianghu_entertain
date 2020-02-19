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
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $currentMaxSort     = $this->model->where(['pid' => $inputDatas['pid']])->max('sort');
        $inputDatas['sort'] = $currentMaxSort + 1;
        $menuEloq           = new BackendSystemMenu();
        $menuEloq->fill($inputDatas);
        if (!$menuEloq->save()) {
            throw new \Exception('300003');
        }
        $msgOut = msgOut(['label' => $menuEloq->label]);
        return $msgOut;
    }
}
