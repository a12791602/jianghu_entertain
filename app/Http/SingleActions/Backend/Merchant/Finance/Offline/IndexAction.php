<?php

namespace App\Http\SingleActions\Backend\Merchant\Finance\Offline;

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
     * ***
     * @param array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $pageSize                  = $this->model::getPageSize();
        $inputDatas['platform_id'] = $this->currentPlatformEloq->id;
        $datas                     = $this->model::with(
            [
             'lastEditor:id,name',
             'author:id,name',
             'bank:id,name',
             'type:id,name',
             'tags:online_finance_id,tag_id',
            ],
        )
        ->filter($inputDatas, SystemFinanceOfflineInfoFilter::class)
        ->paginate($pageSize);
        $result                    = msgOut($datas);
        return $result;
    }
}
