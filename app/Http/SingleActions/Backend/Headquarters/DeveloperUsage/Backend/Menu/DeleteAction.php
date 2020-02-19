<?php

namespace App\Http\SingleActions\Backend\Headquarters\DeveloperUsage\Backend\Menu;

use App\Models\DeveloperUsage\Menu\BackendSystemMenu;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

/**
 * Class for menu delete action.
 */
class DeleteAction
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
        $msgOut = msgOut(['label' => $menuLabel]);
        return $msgOut;
    }
}
