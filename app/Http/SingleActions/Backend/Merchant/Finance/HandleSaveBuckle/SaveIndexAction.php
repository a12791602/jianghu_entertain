<?php

namespace App\Http\SingleActions\Backend\Merchant\Finance\HandleSaveBuckle;

use App\ModelFilters\Finance\SystemFinanceHandleSaveBuckleRecordFilter;
use App\Models\Finance\SystemFinanceHandleSaveBuckleRecord;
use Illuminate\Http\JsonResponse;

/**
 * Class SaveIndexAction
 * @package App\Http\SingleActions\Backend\Merchant\Finance\HandleSaveBuckle
 */
class SaveIndexAction extends BaseAction
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
        $pageSize                = $this->model::getPageSize();
        $inputDatas['direction'] = SystemFinanceHandleSaveBuckleRecord::DIRECTION_IN;
        $data                    = $this->model::with('user:id,mobile,guid,is_tester', 'admin:id,name')
            ->filter($inputDatas, SystemFinanceHandleSaveBuckleRecordFilter::class)
            ->paginate($pageSize);
        return msgOut($data);
    }
}
