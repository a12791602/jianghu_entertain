<?php

namespace App\Http\SingleActions\Backend\Merchant\User\FrontendUser;

use App\ModelFilters\User\UsersLoginLogFilter;
use App\Models\User\UsersLoginLog;
use Illuminate\Http\JsonResponse;

/**
 * 会员登陆记录
 */
class LoginLogAction
{

    /**
     * @var object
     */
    protected $model;

    /**
     * @param UsersLoginLog $usersLoginLog 用户登陆记录Model.
     */
    public function __construct(UsersLoginLog $usersLoginLog)
    {
        $this->model = $usersLoginLog;
    }

    /**
     * @param  array  $inputDatas 接收的数据.
     * @param  string $sign       平台标识.
     * @return JsonResponse
     */
    public function execute(array $inputDatas, string $sign): JsonResponse
    {
        $inputDatas['platformSign'] = $sign;
        $data                       = $this->model
                                        ->filter($inputDatas, UsersLoginLogFilter::class)
                                        ->paginate($this->model::getPageSize());
        $msgOut                     = msgOut($data);
        return $msgOut;
    }
}
