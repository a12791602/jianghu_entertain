<?php

namespace App\Http\SingleActions\Backend\Merchant\Admin\MerchantAdminUser;

use App\Http\Controllers\BackendApi\BackEndApiMainController;
use App\Models\Admin\MerchantAdminAccessGroup;
use App\Models\Admin\MerchantAdminUser;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

/**
 * Class for delete admin action.
 */
class DeleteAdminAction
{

    /**
     * @var object
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
     * 删除管理员
     *
     * @param  BackEndApiMainController $contll     Controller.
     * @param  array                    $inputDatas 传递的参数.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(BackEndApiMainController $contll, array $inputDatas): JsonResponse
    {
        $adminEloq = $this->model->find($inputDatas['id']);
        if ($adminEloq === null) {
            throw new \Exception('300701');
        }
        if ($adminEloq->platform_sign !== $contll->currentPlatformEloq->sign) {
            throw new \Exception('300703');
        }
        if ($adminEloq->accessGroup->is_super === MerchantAdminAccessGroup::IS_SUPER) {
            throw new \Exception('300704');
        }
        if ($adminEloq->remember_token !== null) {
            try {
                JWTAuth::setToken($adminEloq->remember_token);
                JWTAuth::invalidate();
            } catch (JWTException $e) {
                Log::info($e->getMessage());
            }
        }
        try {
            $adminEloq->delete();
            $msgOut = msgOut(true);
        } catch (\Throwable $e) {
            $msgOut = msgOut(false, [], $e->getCode(), $e->getMessage());
        }
        return $msgOut;
    }
}
