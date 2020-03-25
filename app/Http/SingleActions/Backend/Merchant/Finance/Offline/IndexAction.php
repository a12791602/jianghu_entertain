<?php

namespace App\Http\SingleActions\Backend\Merchant\Finance\Offline;

use App\Http\Resources\Backend\Merchant\Finance\Offline\IndexResource;
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

        $data   = $this->model::filter($inputDatas, SystemFinanceOfflineInfoFilter::class)->paginate($pageSize);
        $result = msgOut(IndexResource::collection($data));
        return $result;
    }
}
