<?php

namespace App\Http\SingleActions\Backend\Merchant\Setting\Admin;

use App\Http\SingleActions\MainAction;
use App\Models\Admin\MerchantAdminUser;
use Illuminate\Http\JsonResponse;

/**
 * Class for specific group users action.
 */
class SpecificGroupUsersAction extends MainAction
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

        $data = $this->model
            ->select(
                [
                 'id',
                 'name',
                 'email',
                 'status',
                ],
            )
            ->where('group_id', $inputDatas['id'])
            ->paginate($this->perPage);
        return msgOut($data);
    }
}
