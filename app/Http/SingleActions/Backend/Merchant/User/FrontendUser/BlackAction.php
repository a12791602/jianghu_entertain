<?php

namespace App\Http\SingleActions\Backend\Merchant\User\FrontendUser;

use App\Http\SingleActions\MainAction;
use App\Models\User\FrontendUser;
use App\Models\User\FrontendUsersBlackList;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * 加入黑名单
 */
class BlackAction extends MainAction
{

    /**
     * @var object
     */
    protected $model;

    /**
     * @param Request      $request      Request.
     * @param FrontendUser $frontendUser 用户Model.
     */
    public function __construct(Request $request, FrontendUser $frontendUser)
    {
        parent::__construct($request);
        $this->model = $frontendUser;
    }

    /**
     * @param array $inputDatas 接收的参数.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $user = $this->model->find($inputDatas['id']);
        if ($user === null) {
            throw new \Exception('203000');
        }
        if ($user->status === FrontendUser::STATUS_DISABLE) {
            throw new \Exception('203004');
        }
        $account = $user->account;
        if ($account === null) {
            throw new \Exception('203001');
        }
        //黑名单表数据
        $addData = [
                    'platform_sign'   => $this->currentPlatformEloq->sign,
                    'mobile'          => $user->mobile,
                    'guid'            => $user->guid,
                    'last_login_time' => $user->last_login_time,
                    'register_time'   => $user->created_at,
                    'last_login_ip'   => $user->last_login_ip,
                    'account'         => $account->balance,
                    'remark'          => $inputDatas['remark'],
                   ];
        //插入黑名单表数据并且改变用户状态
        DB::beginTransaction();
        $userBlack = new FrontendUsersBlackList();
        $userBlack->fill($addData);
        if (!$userBlack->save()) {
            DB::rollback();
            throw new \Exception('203002');
        }
        $user->status = FrontendUser::STATUS_DISABLE;
        if (!$user->save()) {
            DB::rollback();
            throw new \Exception('203003');
        }
        DB::commit();
        return msgOut();
    }
}
