<?php

namespace App\Http\SingleActions\Backend\Merchant\User\UserGrade;

use App\Http\SingleActions\MainAction;
use App\Models\User\FrontendUserLevel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * 用户等级-列表
 */
class IndexAction extends MainAction
{

    /**
     * @var object
     */
    protected $model;

    /**
     * @param FrontendUserLevel $usersGrade 用户等级Model.
     * @param Request           $request    Request.
     * @throws \Exception  Exception.
     */
    public function __construct(FrontendUserLevel $usersGrade, Request $request)
    {
        parent::__construct($request);
        $this->model = $usersGrade;
    }

    /**
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(): JsonResponse
    {
        $sign   = $this->currentPlatformEloq->sign;
        $data   = $this->model
                    ->where('platform_sign', $sign)
                    ->orderBy('experience_max', 'asc')
                    ->get(
                        [
                         'id',
                         'name',
                         'experience_min',
                         'experience_max',
                         'promotion_gift',
                         'weekly_gift',
                         'updated_at',
                        ],
                    )
                    ->toArray();
        $msgOut = msgOut($data);
        return $msgOut;
    }
}
