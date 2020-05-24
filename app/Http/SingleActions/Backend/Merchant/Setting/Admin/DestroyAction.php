<?php

namespace App\Http\SingleActions\Backend\Merchant\Setting\Admin;

use App\Models\Admin\MerchantAdminAccessGroup;
use Illuminate\Http\JsonResponse;

/**
 * Class for destroy action.
 */
class DestroyAction
{

    /**
     * @var MerchantAdminAccessGroup
     */
    protected $model;

    /**
     * @param MerchantAdminAccessGroup $merchantAdminAccessGroup MerchantAdminAccessGroup.
     */
    public function __construct(MerchantAdminAccessGroup $merchantAdminAccessGroup)
    {
        $this->model = $merchantAdminAccessGroup;
    }

    /**
     * @param  array $inputDatas 传递的参数.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $adminGroupELoq = $this->model->where(
            [
             [
              'id',
              $inputDatas['id'],
             ],
             [
              'group_name',
              $inputDatas['group_name'],
             ],
            ],
        )->first();
        if ($adminGroupELoq === null) {
            throw new \Exception('200902');
        }
        if (!$adminGroupELoq->delete()) {
            throw new \Exception('200903');
        }
        return msgOut();
    }
}
