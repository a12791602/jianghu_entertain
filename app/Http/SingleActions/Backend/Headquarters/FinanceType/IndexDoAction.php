<?php

namespace App\Http\SingleActions\Backend\Headquarters\FinanceType;

use App\ModelFilters\Finance\SystemFinanceTypeFilter;
use Illuminate\Http\JsonResponse;

/**
 * Class IndexDoAction
 * @package App\Http\SingleActions\Backend\Headquarters\FinanceType
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
        $outputDatas = $this->model::with(
            ['lastEditor', 'author'],
        )->filter($inputDatas, SystemFinanceTypeFilter::class)->paginate($this->model::getPageSize());
        return msgOut(true, $outputDatas);
    }
}
