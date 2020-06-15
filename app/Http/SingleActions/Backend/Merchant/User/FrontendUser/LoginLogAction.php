<?php

namespace App\Http\SingleActions\Backend\Merchant\User\FrontendUser;

use App\Http\Resources\Backend\Merchant\User\FrontendUser\LoginLogResource;
use App\Http\SingleActions\MainAction;
use App\Models\Systems\SystemLogsFrontend;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * 会员登陆记录
 */
class LoginLogAction extends MainAction
{

    /**
     * @var object
     */
    protected $model;

    /**
     * @param SystemLogsFrontend $systemLogsFrontend 前台访问日志Model.
     * @param Request            $request            Request.
     * @throws \Exception Exception.
     */
    public function __construct(SystemLogsFrontend $systemLogsFrontend, Request $request)
    {
        parent::__construct($request);
        $this->model = $systemLogsFrontend;
    }

    /**
     * @param array $inputDatas 接收的数据.
     * @return JsonResponse
     * @throws \RuntimeException Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        if (isset($inputDatas['pageSize'])) {
            $this->model->setPerPage($inputDatas['pageSize']);
        }
        $inputDatas['platform_sign'] = getCurrentPlatformSign();
        $inputDatas['route_name']    = [
                                        'h5-api.login',
                                        'app-api.login',
                                        'pc-api.login',
                                       ];

        $result = $this->model->filter($inputDatas)
            ->select(
                [
                 'ip',
                 'mobile',
                 'user_id',
                 'device',
                 'web_type',
                 'created_at',
                ],
            )->with('user:id,guid')
            ->orderBy('created_at', 'desc')
            ->paginate();
        return msgOut(LoginLogResource::collection($result));
    }
}
