<?php

namespace App\Http\SingleActions\Backend\Merchant\User\UserGrade;

use App\Http\SingleActions\MainAction;
use App\Models\User\UsersCommissionConfig;
use App\Models\User\UsersCommissionConfigDetail;
use App\Models\User\UsersGrade;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * 用户等级-添加
 */
class DoAddAction extends MainAction
{

    /**
     * @var object
     */
    protected $model;

    /**
     * @param UsersGrade $usersGrade 用户等级Model.
     * @param Request    $request    Request.
     * @throws \Exception Exception.
     */
    public function __construct(UsersGrade $usersGrade, Request $request)
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
        $usersGrades = $this->model->where('platform_sign', $this->currentPlatformEloq->sign)->get();
        //验证最小经验值与其他等级设定是否有冲突
        $checkMinExp = $this->_checkExp(
            $usersGrades,
            $this->currentPlatformEloq->sign,
            (int) $inputDatas['experience_min'],
        );
        if ($checkMinExp->isNotEmpty()) {
            throw new \Exception('200701');
        }
        //验证最大经验值与其他等级设定是否有冲突
        $checkMaxExp = $this->_checkExp(
            $usersGrades,
            $this->currentPlatformEloq->sign,
            (int) $inputDatas['experience_max'],
        );
        if ($checkMaxExp->isNotEmpty()) {
            throw new \Exception('200702');
        }

        DB::beginTransaction();
        //插入用户等级
        $this->_insertUserGrade($inputDatas, $this->currentPlatformEloq->sign);
        //插入用户洗码设置数据
        $this->_insertUsersCommission($this->currentPlatformEloq->sign);
        DB::commit();

        $msgOut = msgOut(['name' => $this->model->name]);
        return $msgOut;
    }

    /**
     * 检查经验值是否有冲突
     *
     * @param object  $usersGrades 当前平台的所有等级.
     * @param string  $sign        平台标识.
     * @param integer $experience  经验值.
     * @return mixed
     */
    private function _checkExp(object $usersGrades, string $sign, int $experience)
    {
        $checkExp = $usersGrades->where('platform_sign', $sign)
            ->where('experience_min', '>=', $experience)
            ->where('experience_min', '<=', $experience);
        return $checkExp;
    }

    /**
     * 插入等级数据
     *
     * @param array  $inputDatas 接收的参数.
     * @param string $sign       平台标识.
     * @throws \Exception Exception.
     * @return void
     */
    private function _insertUserGrade(array $inputDatas, string $sign): void
    {
        $inputDatas['platform_sign'] = $sign;
        $this->model->fill($inputDatas);
        if (!$this->model->save()) {
            DB::rollback();
            throw new \Exception('200703');
        }
    }

    /**
     * 插入洗码设置等级数据
     *
     * @param string $sign 平台标识.
     * @throws \Exception Exception.
     * @return void
     */
    private function _insertUsersCommission(string $sign): void
    {
        $allCommissionConfig = UsersCommissionConfig::with('configDetail')
            ->where('platform_sign', $sign)
            ->get();
        foreach ($allCommissionConfig as $commissionConfig) {
            $insertData   = [
                             'config_id'     => $commissionConfig->id,
                             'grade_id'      => $this->model->id,
                             'percent'       => 0,
                             'grade_exp_max' => $this->model->experience_max,
                            ];
            $configDetail = new UsersCommissionConfigDetail();
            $configDetail->fill($insertData);
            if (!$configDetail->save()) {
                DB::rollback();
                throw new \Exception('200707');
            }
        }
    }
}
