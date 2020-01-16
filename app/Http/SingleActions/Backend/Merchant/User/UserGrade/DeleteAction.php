<?php

namespace App\Http\SingleActions\Backend\Merchant\User\UserGrade;

use App\Http\Controllers\BackendApi\BackEndApiMainController;
use App\Models\User\UsersCommissionConfigDetail;
use App\Models\User\UsersGrade;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

/**
 * 用户等级-删除
 */
class DeleteAction
{

    /**
     * @var object
     */
    protected $model;

    /**
     * @param UsersGrade $usersGrade 用户等级Model.
     */
    public function __construct(UsersGrade $usersGrade)
    {
        $this->model = $usersGrade;
    }

    /**
     * @param  BackEndApiMainController $contll     Controller.
     * @param  array                    $inputDatas 接收的数据.
     * @throws \Exception Exception.
     * @return JsonResponse
     */
    public function execute(BackEndApiMainController $contll, array $inputDatas): JsonResponse
    {
        //检查当前平台的这条数据是否存在。
        $currentUsersGrade = $this->model->where(
            [
             [
              'id',
              $inputDatas['id'],
             ],
             [
              'platform_sign',
              $contll->currentPlatformEloq->sign,
             ],
            ],
        )->first();
        if (!$currentUsersGrade) {
            throw new \Exception('200704');
        }
        DB::beginTransaction();
        //修改该等级的用户等级ID = null
        if ($currentUsersGrade->user->isNotEmpty()) {
            $users      = $currentUsersGrade->user();
            $updateUser = $users->update(['grade_id' => null]);
            if (!$updateUser) {
                DB::rollback();
                throw new \Exception('200706');
            }
        }
        //删除该等级的洗码设置数据
        $deleteCommissionDetail = UsersCommissionConfigDetail::where('grade_id', $currentUsersGrade->id)->delete();
        if (!$deleteCommissionDetail) {
            DB::rollback();
            throw new \Exception('200709');
        }
        //删除这条等级数据。
        if (!$currentUsersGrade->delete()) {
            DB::rollback();
            throw new \Exception('200705');
        }
        DB::commit();
        $msgOut = msgOut();
        return $msgOut;
    }
}
