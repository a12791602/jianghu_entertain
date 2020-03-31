<?php

namespace App\Http\SingleActions\Backend\Merchant\User\UsersTag;

use App\Http\SingleActions\MainAction;
use App\Models\User\FrontendUser;
use App\Models\User\UsersTag;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * 用户标签-删除
 */
class DeleteAction extends MainAction
{

    /**
     * @var object
     */
    protected $model;

    /**
     * @param UsersTag $usersTag 用户标签Model.
     * @param Request  $request  Request.
     * @throws \Exception Exception.
     */
    public function __construct(UsersTag $usersTag, Request $request)
    {
        parent::__construct($request);
        $this->model = $usersTag;
    }

    /**
     * @param  array $inputDatas 接收的参数.
     * @throws \Exception Exception.
     * @return JsonResponse
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $usersTagEloq = $this->model->where(
            [
             [
              'id',
              $inputDatas['id'],
             ],
             [
              'platform_sign',
              $this->currentPlatformEloq->sign,
             ],
            ],
        )->first();
        if (!$usersTagEloq) {
            throw new \Exception('200501');
        }
        DB::beginTransaction();
        //清除该标签下的会员标签
        if ($usersTagEloq->user->isNotEmpty()) {
            $updateUser = FrontendUser::where(['user_tag_id' => $usersTagEloq->id])->update(['user_tag_id' => null]);
            if (!$updateUser) {
                DB::rollback();
                throw new \Exception('200504');
            }
        }
        //删除标签
        $title = $usersTagEloq->title;
        if (!$usersTagEloq->delete()) {
            DB::rollback();
            throw new \Exception('200503');
        }
        DB::commit();
        return msgOut(['title' => $title]);
    }
}
