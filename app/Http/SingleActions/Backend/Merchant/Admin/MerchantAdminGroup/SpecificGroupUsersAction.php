<?php

namespace App\Http\SingleActions\Backend\Merchant\Admin\MerchantAdminGroup;

use App\Models\Admin\MerchantAdminUser;
use Illuminate\Http\JsonResponse;

/**
 * Class for specific group users action.
 */
class SpecificGroupUsersAction
{

    /**
     * @var MerchantAdminUser
     */
    protected $model;

    /**
     * @param MerchantAdminUser $merchantAdminUser MerchantAdminUser.
     */
    public function __construct(MerchantAdminUser $merchantAdminUser)
    {
        $this->model = $merchantAdminUser;
    }

    /**
     * @param  array $inputDatas 传递的参数.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $data   = $this->model->where('group_id', $inputDatas['id'])->paginate($this->model::getPageSize());
        $msgOut = msgOut(true, $data);
        return $msgOut;
    }
}
