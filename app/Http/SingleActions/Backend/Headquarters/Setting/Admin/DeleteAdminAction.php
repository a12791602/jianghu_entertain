<?php

namespace App\Http\SingleActions\Backend\Headquarters\Setting\Admin;

use App\Http\SingleActions\MainAction;
use App\Models\Admin\BackendAdminUser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

/**
 * Class for delete admin action.
 */
class DeleteAdminAction extends MainAction
{

    /**
     * @var object $model BackendAdminUser.
     */
    protected $model;

    /**
     * @param Request          $request          Request.
     * @param BackendAdminUser $backendAdminUser BackendAdminUser.
     */
    public function __construct(
        Request $request,
        BackendAdminUser $backendAdminUser
    ) {
        parent::__construct($request);
        $this->model = $backendAdminUser;
    }

    /**
     * 删除管理员
     * @param array $inputDatas 传递的参数.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $adminEloq = $this->model->find($inputDatas['id']);
        if ($adminEloq !== null) {
            if ($adminEloq->remember_token !== null) {
                try {
                    JWTAuth::setToken($adminEloq->remember_token);
                    JWTAuth::invalidate();
                } catch (JWTException $e) {
                    Log::info($e->getMessage());
                }
            }
            $adminEloq->delete();
            return msgOut(['name' => $inputDatas['name']]);
        }
        throw new \Exception('300701');
    }
}
