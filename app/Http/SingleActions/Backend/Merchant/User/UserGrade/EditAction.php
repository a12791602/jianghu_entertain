<?php

namespace App\Http\SingleActions\Backend\Merchant\User\UserGrade;

use App\Http\SingleActions\MainAction;
use App\Models\User\FrontendUserLevel;
use App\Models\User\UsersCommissionConfigDetail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * 用户等级-编辑
 */
class EditAction extends MainAction
{

    /**
     * @var object
     */
    protected $model;

    /**
     * @param FrontendUserLevel $usersGrade 用户等级Model.
     * @param Request           $request    Request.
     * @throws \Exception Exception.
     */
    public function __construct(FrontendUserLevel $usersGrade, Request $request)
    {
        parent::__construct($request);
        $this->model = $usersGrade;
    }

    /**
     * @param array $inputDatas 接收的数据.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
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
              $this->currentPlatformEloq->sign,
             ],
            ],
        )->first();
        if (!$currentUsersGrade) {
            throw new \Exception('200704');
        }
        //当前平台的所有等级设置数据，用于后面验证经验值是否合法。
        $usersGrades = $this->model->where('platform_sign', $this->currentPlatformEloq->sign)->get();
        //验证最小经验值与其他等级设定是否有冲突。
        $checkMinExp = $this->_checkExp(
            $usersGrades,
            $inputDatas['id'],
            $this->currentPlatformEloq->sign,
            $inputDatas['experience_min'],
        );
        if ($checkMinExp->isNotEmpty()) {
            throw new \Exception('200701');
        }
        //验证最大经验值与其他等级设定是否有冲突。
        $checkMaxExp = $this->_checkExp(
            $usersGrades,
            $inputDatas['id'],
            $this->currentPlatformEloq->sign,
            $inputDatas['experience_max'],
        );
        if ($checkMaxExp->isNotEmpty()) {
            throw new \Exception('200702');
        }

        //编辑数据。
        DB::beginTransaction();
        if ($currentUsersGrade->experience_max !== $inputDatas['experience_max']) {
            $this->_editCommissionDetail($currentUsersGrade->id, (float) $inputDatas['experience_max']);
        }
        $currentUsersGrade = $this->_editUserGrade($currentUsersGrade, $inputDatas);
        DB::commit();

        $msgOut = msgOut(['name' => $currentUsersGrade->name]);
        return $msgOut;
    }

    /**
     * @param object  $usersGrades 当前平台的所有等级.
     * @param integer $id          当前数据ID.
     * @param string  $sign        平台标识.
     * @param integer $experience  经验值.
     * @return mixed
     */
    private function _checkExp(object $usersGrades, int $id, string $sign, int $experience)
    {
        $checkExp = $usersGrades->where('id', '!=', $id)
            ->where('platform_sign', $sign)
            ->where('experience_min', '>=', $experience)
            ->where('experience_min', '<=', $experience);
        return $checkExp;
    }

    /**
     * @param FrontendUserLevel $currentUsersGrade 用户等级.
     * @param array             $editDatas         修改的数据.
     * @return FrontendUserLevel
     * @throws \Exception Exception.
     */
    private function _editUserGrade(
        FrontendUserLevel $currentUsersGrade,
        array $editDatas
    ): FrontendUserLevel {
        $currentUsersGrade->fill($editDatas);
        if (!$currentUsersGrade->save()) {
            throw new \Exception('200703');
        }
        return $currentUsersGrade;
    }

    /**
     * @param  integer $gradeId       等级ID.
     * @param  float   $experienceMax 最大经验值.
     * @throws \Exception Exception.
     * @return void
     */
    private function _editCommissionDetail(int $gradeId, float $experienceMax): void
    {
        $updateCommissionDetail = UsersCommissionConfigDetail::where('grade_id', $gradeId)
            ->update(['grade_exp_max' => $experienceMax]);
        if (!$updateCommissionDetail) {
            DB::rollback();
            throw new \Exception('200708');
        }
    }
}
