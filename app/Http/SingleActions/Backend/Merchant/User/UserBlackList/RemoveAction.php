<?php

namespace App\Http\SingleActions\Backend\Merchant\User\UserBlackList;

use App\Http\SingleActions\MainAction;
use App\Models\User\FrontendUser;
use App\Models\User\FrontendUsersBlackList;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * 解除黑名单
 */
class RemoveAction extends MainAction
{

    /**
     * @var object
     */
    protected $model;

    /**
     * @param Request                $request                Request.
     * @param FrontendUsersBlackList $frontendUsersBlackList 用户黑名单Model.
     */
    public function __construct(
        Request $request,
        FrontendUsersBlackList $frontendUsersBlackList
    ) {
        parent::__construct($request);
        $this->model = $frontendUsersBlackList;
    }

    /**
     * @param array $inputDatas 接收的参数.
     * @throws \Exception Exception.
     * @return JsonResponse
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $userBlackELoq = $this->model->filter(
            [
             'data_id'       => $inputDatas['id'],
             'platform_sign' => $this->currentPlatformEloq->sign,
             'status'        => $this->model::STATUS_BLACK,
            ],
        )->first();
        if ($userBlackELoq === null) {
            throw new \Exception('200300');
        }
        $user = $userBlackELoq->user;
        if ($user === null) {
            throw new \Exception('200302');
        }
        $userBlackELoq->status      = $this->model::STATUS_WHITE;
        $userBlackELoq->remove_time = Carbon::now();
        DB::beginTransaction();
        if (!$userBlackELoq->save()) {
            DB::rollback();
            throw new \Exception('200301');
        }
        $user->status = FrontendUser::STATUS_NORMAL;
        if (!$user->save()) {
            DB::rollback();
            throw new \Exception('200303');
        }
        DB::commit();
        return msgOut(['mobile' => $userBlackELoq->mobile]);
    }
}
