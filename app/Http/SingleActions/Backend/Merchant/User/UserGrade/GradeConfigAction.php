<?php

namespace App\Http\SingleActions\Backend\Merchant\User\UserGrade;

use App\Http\Controllers\BackendApi\BackEndApiMainController;
use App\Models\User\UsersGradesRule;
use Illuminate\Http\JsonResponse;

/**
 * 用户等级规则
 */
class GradeConfigAction
{

    /**
     * @var object
     */
    protected $model;

    /**
     * @param UsersGradesRule $usersGradesRule 用户等级规则Model.
     */
    public function __construct(UsersGradesRule $usersGradesRule)
    {
        $this->model = $usersGradesRule;
    }

    /**
     * @param  BackEndApiMainController $contll     Controller.
     * @param  array                    $inputDatas 接收的参数.
     * @throws \Exception Exception.
     * @return JsonResponse
     */
    public function execute(
        BackEndApiMainController $contll,
        array $inputDatas
    ): JsonResponse {
        $gradesRuleEloq = $this->model->where('platform_sign', $contll->currentPlatformEloq->sign)->first();
        if (!$gradesRuleEloq) {
            $inputDatas['platform_sign'] = $contll->currentPlatformEloq->sign;
            $gradesRuleEloq              = $this->model;
        }
        $gradesRuleEloq->fill($inputDatas);
        if (!$gradesRuleEloq->save()) {
            throw new \Exception('200700');
        }
        $msgOut = msgOut();
        return $msgOut;
    }
}
