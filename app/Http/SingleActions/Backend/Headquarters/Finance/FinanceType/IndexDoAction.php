<?php

namespace App\Http\SingleActions\Backend\Headquarters\Finance\FinanceType;

use App\ModelFilters\Finance\SystemFinanceTypeFilter;
use Illuminate\Http\JsonResponse;

/**
 * Class IndexDoAction
 * @package App\Http\SingleActions\Backend\Headquarters\Finance\FinanceType
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
            ],
        )->filter($inputDatas, SystemFinanceTypeFilter::class)->paginate($pageSize);
        $msgOut      = msgOut($outputDatas);
        return $msgOut;
    }
}
