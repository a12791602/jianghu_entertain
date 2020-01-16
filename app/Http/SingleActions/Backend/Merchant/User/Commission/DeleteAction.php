<?php

namespace App\Http\SingleActions\Backend\Merchant\User\Commission;

use App\Models\User\UsersCommissionConfig;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

/**
 * 洗码设置-删除
 */
class DeleteAction
{

    /**
     * @var object
     */
    protected $model;

    /**
     * @param UsersCommissionConfig $usersCommissionConfig 洗码Model.
     */
    public function __construct(UsersCommissionConfig $usersCommissionConfig)
    {
        $this->model = $usersCommissionConfig;
    }

    /**
     * @param array $inputDatas 接收的参数.
     * @throws \Exception Exception.
     * @return JsonResponse
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $commissionConfig = $this->model->find($inputDatas['id']);
        if (!$commissionConfig) {
            throw new \Exception('200811');
        }
        $commissionDetail = $commissionConfig->configDetail();
        //删除数据-开始
        DB::beginTransaction();
        if (!$commissionConfig->delete()) {
            DB::rollback();
            throw new \Exception('200815');
        }
        if ($commissionDetail) {
            if (!$commissionDetail->delete()) {
                DB::rollback();
                throw new \Exception('200816');
            }
        }
        DB::commit();
        //删除数据-完成
        $msgOut = msgOut();
        return $msgOut;
    }
}
