<?php

namespace App\Http\SingleActions\Backend\Headquarters\DeveloperUsage\Backend\Menu;

use App\Http\SingleActions\MainAction;
use App\Models\DeveloperUsage\Menu\BackendSystemMenu;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class for menu do add action.
 */
class DoAddAction extends MainAction
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
        $currentMaxSort     = $this->model->where(['pid' => $inputDatas['pid']])->max('sort');
        $inputDatas['sort'] = $currentMaxSort + 1;
        $menuEloq           = new BackendSystemMenu();
        $menuEloq->fill($inputDatas);
        if (!$menuEloq->save()) {
            throw new \Exception('300003');
        }
        $this->model->deleteCache();
        $msgOut = msgOut(['label' => $menuEloq->label]);
        return $msgOut;
    }
}
