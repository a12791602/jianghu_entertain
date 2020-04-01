<?php

namespace App\Http\SingleActions\Backend\Merchant\Finance\Online;

use App\Http\Resources\Backend\Merchant\Finance\Online\IndexResource;
use App\ModelFilters\Finance\SystemFinanceOnlineInfoFilter;
use Illuminate\Http\JsonResponse;

/**
 * Class IndexAction
 * @package App\Http\SingleActions\Backend\Merchant\Finance\Online
 */
class IndexAction extends BaseAction
{

    /**
     * @var mixed
     */
    protected $model;

    /**
     * @param array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $inputDatas['platform_sign'] = $this->currentPlatformEloq->sign;
        $pageSize                    = $this->model::getPageSize();
        $data                        = $this->model::with(
            [
             'channel:id,name,sign',
             'author:id,name',
             'lastEditor:id,name',
             'tags:online_finance_id,tag_id',
            ],
        )->filter($inputDatas, SystemFinanceOnlineInfoFilter::class)->paginate($pageSize);
        return msgOut(IndexResource::collection($data));
    }
}
