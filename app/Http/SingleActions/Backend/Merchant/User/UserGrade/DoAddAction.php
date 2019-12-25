<?php

namespace App\Http\SingleActions\Backend\Merchant\User\UserGrade;

use App\Http\Controllers\BackendApi\BackEndApiMainController;
use App\Models\User\UsersGrade;
use Illuminate\Http\JsonResponse;

/**
 * 用户等级-添加
 */
class DoAddAction
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
    public function execute(
        BackEndApiMainController $contll,
        array $inputDatas
    ): JsonResponse {
        $usersGrades = $this->model->where('platform_sign', $contll->currentPlatformEloq->sign)->get();
        //验证最小经验值与其他等级设定是否有冲突
        $checkMinExp = $this->_checkExp(
            $usersGrades,
            $contll->currentPlatformEloq->sign,
            (int) $inputDatas['experience_min'],
        );
        if ($checkMinExp->isNotEmpty()) {
            throw new \Exception('200701');
        }
        //验证最大经验值与其他等级设定是否有冲突
        $checkMaxExp = $this->_checkExp(
            $usersGrades,
            $contll->currentPlatformEloq->sign,
            (int) $inputDatas['experience_max'],
        );
        if ($checkMaxExp->isNotEmpty()) {
            throw new \Exception('200702');
        }
        //插入用户等级
        $inputDatas['platform_sign'] = $contll->currentPlatformEloq->sign;
        $this->model->fill($inputDatas);
        if (!$this->model->save()) {
            throw new \Exception('200703');
        }
        $msgOut = msgOut(true, ['name' => $this->model->name]);
        return $msgOut;
    }

    /**
     * @param object  $usersGrades 当前平台的所有等级.
     * @param string  $sign        平台标识.
     * @param integer $experience  经验值.
     * @return mixed
     */
    private function _checkExp(
        object $usersGrades,
        string $sign,
        int $experience
    ) {
        $checkExp = $usersGrades->where('platform_sign', $sign)
        ->where('experience_min', '>=', $experience)
        ->where('experience_min', '<=', $experience);
        return $checkExp;
    }
}
