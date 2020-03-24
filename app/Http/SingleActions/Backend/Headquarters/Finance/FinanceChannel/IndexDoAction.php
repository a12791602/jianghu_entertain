<?php

namespace App\Http\SingleActions\Backend\Headquarters\Finance\FinanceChannel;

use App\ModelFilters\Finance\SystemFinanceChannelFilter;
use Illuminate\Http\JsonResponse;

/**
 * Class IndexDoAction
 * @package App\Http\SingleActions\Backend\Headquarters\Finance\FinanceChannel
 */
class IndexDoAction extends BaseAction
{

    /**
     * @var object $model
     */
    protected $model;
    /**
     * @param array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $pageSize    = $this->model::getPageSize();
        $outputDatas = $this->model::with(
            [
             'lastEditor:id,name',
             'author:id,name',
             'vendor:id,name',
             'type:id,name',
            ],
        )->filter($inputDatas, SystemFinanceChannelFilter::class)->paginate($pageSize);
        $msgOut      = msgOut($outputDatas);
        return $msgOut;
    }
}
