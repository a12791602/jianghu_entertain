<?php

namespace App\Http\SingleActions\Backend\Headquarters\DeveloperUsage\Merchant\Menu;

use App\Models\DeveloperUsage\Menu\MerchantSystemMenu;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

/**
 * Class for menu delete action.
 */
class DeleteAction
{

    /**
     * @var MerchantSystemMenu
     */
    protected $model;

    /**
     * @param MerchantSystemMenu $merchantSystemMenu Model.
     */
    public function __construct(MerchantSystemMenu $merchantSystemMenu)
    {
        $this->model = $merchantSystemMenu;
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
            throw new \Exception('202801');
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
            throw new \Exception('202802');
        }
        DB::commit();
        $this->model->deleteCache();
        $msgOut = msgOut(['label' => $menuLabel]);
        return $msgOut;
    }
}
