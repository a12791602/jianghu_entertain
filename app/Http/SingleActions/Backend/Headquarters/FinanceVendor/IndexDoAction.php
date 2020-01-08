<?php

namespace App\Http\SingleActions\Backend\Headquarters\FinanceVendor;

use App\ModelFilters\Finance\SystemFinanceVendorFilter;
use Illuminate\Http\JsonResponse;

/**
 * Class IndexDoAction
 * @package App\Http\SingleActions\Backend\Headquarters\FinanceVendor
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
    public function execute(array $inputDatas) :JsonResponse
    {
        $pageSize = $this->model::getPageSize();
        $outputDatas = $this->model::with(
            ['lastEditor:id,name', 'author:id,name'],
        )->filter($inputDatas, SystemFinanceVendorFilter::class)->paginate($pageSize);
        return msgOut(true, $outputDatas);
    }
}
