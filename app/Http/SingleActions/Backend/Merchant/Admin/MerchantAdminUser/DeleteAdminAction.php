<?php

namespace App\Http\SingleActions\Backend\Merchant\Admin\MerchantAdminUser;

use App\Http\SingleActions\MainAction;
use App\Models\Admin\MerchantAdminAccessGroup;
use App\Models\Admin\MerchantAdminUser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Facades\JWTAuth;

/**
 * Class for delete admin action.
 */
class DeleteAdminAction extends MainAction
{

    /**
     * @var object
     */
    protected $model;

    /**
     * @param MerchantAdminUser $merchantAdminUser MerchantAdminUser.
     * @param Request           $request           Request.
     * @throws \Exception Exception.
     */
    public function __construct(MerchantAdminUser $merchantAdminUser, Request $request)
    {
        parent::__construct($request);
        $this->model = $merchantAdminUser;
    }

    /**
     * 删除管理员
     *
     * @param array $inputDatas 传递的参数.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $adminEloq = $this->model->find($inputDatas['id']);
        if ($adminEloq === null) {
            throw new \Exception('201000');
        }
        if ($adminEloq->platform_sign !== $this->currentPlatformEloq->sign) {
            throw new \Exception('201001');
        }
        if ($adminEloq->accessGroup->is_super === MerchantAdminAccessGroup::IS_SUPER) {
            throw new \Exception('201002');
        }
        if ($adminEloq->remember_token !== null) {
            try {
                JWTAuth::setToken($adminEloq->remember_token);
                JWTAuth::invalidate();
            } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
                Log::info($e->getMessage());
            }
        }
        if (!$adminEloq->delete()) {
            throw new \Exception('201003');
        }

        $msgOut = msgOut();
        return $msgOut;
    }
}
