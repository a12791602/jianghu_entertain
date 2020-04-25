<?php

namespace App\Http\SingleActions\Backend\Headquarters\DeveloperUsage\SystemBank;

use App\ModelFilters\Finance\SystemBankFilter;
use Illuminate\Http\JsonResponse;

/**
 * Class IndexAction
 * @package App\Http\SingleActions\Backend\Headquarters\DeveloperUsage\SystemBank
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
        if (isset($inputDatas['pageSize'])) {
            $this->model->setPerPage($inputDatas['pageSize']);
        }
        $outputDatas = $this->model::with(
            [
             'lastEditor:id,name',
             'author:id,name',
            ],
        )->filter($inputDatas, SystemBankFilter::class)
        ->paginate();
        return msgOut($outputDatas);
    }
}
