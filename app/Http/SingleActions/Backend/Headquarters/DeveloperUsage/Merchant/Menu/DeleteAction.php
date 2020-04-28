<?php

namespace App\Http\SingleActions\Backend\Headquarters\DeveloperUsage\Merchant\Menu;

use App\Http\SingleActions\MainAction;
use App\Models\DeveloperUsage\Menu\MerchantSystemMenu;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class for menu delete action.
 */
class DeleteAction extends MainAction
{

    /**
     * @var MerchantSystemMenu
     */
    protected $model;

    /**
     * @param Request            $request            Request.
     * @param MerchantSystemMenu $merchantSystemMenu Model.
     */
    public function __construct(
        Request $request,
        MerchantSystemMenu $merchantSystemMenu
    ) {
        parent::__construct($request);
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
        if (!$menuEloq instanceof $this->model) {
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
        return msgOut(['label' => $menuLabel]);
    }
}
