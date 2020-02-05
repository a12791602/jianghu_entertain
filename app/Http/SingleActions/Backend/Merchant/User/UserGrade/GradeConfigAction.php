<?php

namespace App\Http\SingleActions\Backend\Merchant\User\UserGrade;

use App\Http\SingleActions\MainAction;
use App\Models\User\UsersGradesRule;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * 用户等级规则
 */
class GradeConfigAction extends MainAction
{

    /**
     * @var object
     */
    protected $model;

    /**
     * @param UsersGradesRule $usersGradesRule 用户等级规则Model.
     * @param Request         $request         Request.
     * @throws \Exception Exception.
     */
    public function __construct(UsersGradesRule $usersGradesRule, Request $request)
    {
        parent::__construct($request);
        $this->model = $usersGradesRule;
    }

    /**
     * @param array $inputDatas 接收的参数.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $gradesRuleEloq = $this->model->where('platform_sign', $this->currentPlatformEloq->sign)->first();
        if (!$gradesRuleEloq) {
            $inputDatas['platform_sign'] = $this->currentPlatformEloq->sign;
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
