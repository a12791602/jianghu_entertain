<?php

namespace App\Http\SingleActions\Backend\Merchant\Setting\Admin;

use App\Http\SingleActions\MainAction;
use App\Models\Admin\MerchantAdminUser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * 修改管理员密码
 */
class UpdatePasswordAction extends MainAction
{

    /**
     * 后台管理员
     * @var object $model MerchantAdminUser
     */
    protected $model;

    /**
     * @param Request           $request           Request.
     * @param MerchantAdminUser $merchantAdminUser MerchantAdminUser.
     */
    public function __construct(
        Request $request,
        MerchantAdminUser $merchantAdminUser
    ) {
        parent::__construct($request);
        $this->model = $merchantAdminUser;
    }

    /**
     * @param array $inputDatas 传递的参数.
     * @throws \Exception Exception.
     * @return JsonResponse
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $adminEloq = $this->model::where(
            [
             [
              'id',
              '=',
              $inputDatas['id'],
             ],
             [
              'platform_sign',
              '=',
              $this->currentPlatformEloq->sign,
             ],
            ],
        )->first();
        if ($adminEloq === null) {
            throw new \Exception('301100');
        }
        $adminEloq->password = Hash::make($inputDatas['password']);
        $adminEloq->save();
        return msgOut(['name' => $adminEloq->name]);
    }
}
