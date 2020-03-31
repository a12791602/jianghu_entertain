<?php

namespace App\Http\SingleActions\Backend\Headquarters\DeveloperUsage\Backend\Menu;

use App\Http\SingleActions\MainAction;
use App\Models\DeveloperUsage\Menu\BackendSystemMenu;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class for menu edit action.
 */
class EditAction extends MainAction
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
        $menuEloq = $this->model::find($inputDatas['id']);
        if (!$menuEloq) {
            throw new \Exception('300004');
        }
        $menuEloq->fill($inputDatas);
        if (!$menuEloq->save()) {
            throw new \Exception('300000');
        }
        $this->model->deleteCache();
        return msgOut(['label' => $menuEloq->label]);
    }
}
