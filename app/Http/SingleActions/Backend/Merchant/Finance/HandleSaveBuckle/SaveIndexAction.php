<?php

namespace App\Http\SingleActions\Backend\Merchant\Finance\HandleSaveBuckle;

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
        $inputDatas['direction'] = SystemFinanceHandleSaveBuckleRecord::DIRECTION_IN;
        $data                    = $this->model::with('user:id,mobile,guid,is_tester', 'admin:id,name')
            ->filter($inputDatas)
            ->paginate($this->perPage);
        return msgOut($data);
    }
}
