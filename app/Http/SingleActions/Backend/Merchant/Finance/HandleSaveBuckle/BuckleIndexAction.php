<?php

namespace App\Http\SingleActions\Backend\Merchant\Finance\HandleSaveBuckle;

use App\Models\Finance\SystemFinanceHandleSaveBuckleRecord;
use Illuminate\Http\JsonResponse;

/**
 * Class BuckleIndexAction
 * @package App\Http\SingleActions\Backend\Merchant\Finance\HandleSaveBuckle
 */
class BuckleIndexAction extends BaseAction
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
        $inputDatas['direction'] = SystemFinanceHandleSaveBuckleRecord::DIRECTION_OUT;
        $data                    = $this->model->with('user:id,mobile,guid,is_tester', 'admin:id,name')
            ->filter($inputDatas)
            ->paginate();
        return msgOut($data);
    }
}
