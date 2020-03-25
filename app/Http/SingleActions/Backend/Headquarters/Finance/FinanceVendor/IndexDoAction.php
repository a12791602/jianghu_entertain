<?php

namespace App\Http\SingleActions\Backend\Headquarters\Finance\FinanceVendor;

use App\ModelFilters\Finance\SystemFinanceVendorFilter;
use Illuminate\Http\JsonResponse;

/**
 * Class IndexDoAction
 * @package App\Http\SingleActions\Backend\Headquarters\Finance\FinanceVendor
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
            ['lastEditor:id,name', 'author:id,name', 'whiteList:finance_vendor_id,ips'],
        )->filter($inputDatas, SystemFinanceVendorFilter::class)->paginate($pageSize);
        return msgOut($outputDatas);
    }
}
