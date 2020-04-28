<?php

namespace App\Http\SingleActions\Backend\Headquarters\DeveloperUsage\Backend\Menu;

use App\Http\SingleActions\MainAction;
use App\Models\DeveloperUsage\Menu\BackendSystemMenu;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class for menu delete action.
 */
class DeleteAction extends MainAction
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
        $menuEloq = $this->model->find($inputDatas['id']);
        if (!$menuEloq instanceof $this->model) {
            throw new \Exception('300004');
        }
        $menuPid   = $menuEloq->pid;
        $menuSort  = $menuEloq->sort;
        $menuLabel = $menuEloq->label;
        DB::beginTransaction();
        $this->model->where(
            [
             [
              'pid',
              $menuPid,
             ],
             [
              'sort',
              '>',
              $menuSort,
             ],
            ],
        )->decrement('sort');
        if (!$menuEloq->delete()) {
            DB::rollback();
            throw new \Exception('300002');
        }
        DB::commit();
        $this->model->deleteCache();
        return msgOut(['label' => $menuLabel]);
    }
}
