<?php

namespace App\Http\SingleActions\Backend\Headquarters\SystemBank;

use App\ModelFilters\Finance\SystemBankFilter;
use Illuminate\Http\JsonResponse;

/**
 * Class IndexAction
 * @package App\Http\SingleActions\Backend\Headquarters\SystemBank
 */
class IndexAction extends BaseAction
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
        )->filter($inputDatas, SystemBankFilter::class)->paginate($pageSize);
        $msgOut      = msgOut($outputDatas);
        return $msgOut;
    }
}
