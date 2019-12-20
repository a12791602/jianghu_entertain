<?php

namespace App\Http\SingleActions\Backend\Merchant\Finance\Offline;

use App\Http\Controllers\BackendApi\BackEndApiMainController;
use App\ModelFilters\Finance\SystemFinanceOfflineInfoFilter;
use Illuminate\Http\JsonResponse;

/**
 * Class IndexAction
 * @package App\Http\SingleActions\Backend\Merchant\Finance\Offline
 */
class IndexAction extends BaseAction
{

    /**
     * @var mixed
     */
    protected $model;

    /**
     * @param BackEndApiMainController $contll     Contll.
     * @param array                    $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(BackEndApiMainController $contll, array $inputDatas): JsonResponse
    {
        $pageSize                  = $this->model::getPageSize();
        $inputDatas['platform_id'] = $contll->currentPlatformEloq->id;
        $datas                     = $this->model::with('lastEditor:id,name', 'author:id,name')
            ->filter($inputDatas, SystemFinanceOfflineInfoFilter::class)
            ->paginate($pageSize);
        $result                    = msgOut(true, $datas);
        return $result;
    }
}
