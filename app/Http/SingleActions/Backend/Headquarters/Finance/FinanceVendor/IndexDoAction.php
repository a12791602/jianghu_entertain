<?php

namespace App\Http\SingleActions\Backend\Headquarters\Finance\FinanceVendor;

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
        if (isset($inputDatas['pageSize'])) {
            $this->model->setPerPage($inputDatas['pageSize']);
        }
        $outputDatas = $this->model::with(
            [
             'lastEditor:id,name',
             'author:id,name',
             'whiteList:finance_vendor_id,ips',
            ],
        )->filter($inputDatas)
        ->paginate();
        return msgOut($outputDatas);
    }
}
