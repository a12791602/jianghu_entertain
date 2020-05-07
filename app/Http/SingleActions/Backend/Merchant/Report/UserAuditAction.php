<?php

namespace App\Http\SingleActions\Backend\Merchant\Report;

use App\Http\SingleActions\MainAction;
use App\Models\User\FrontendUsersAudit;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * 用户稽核-列表
 */
class UserAuditAction extends MainAction
{

    /**
     * @var object
     */
    protected $model;

    /**
     * @param FrontendUsersAudit $frontendUsersAudit 用户银行卡Model.
     * @param Request            $request            Request.
     * @throws \Exception Exception.
     */
    public function __construct(FrontendUsersAudit $frontendUsersAudit, Request $request)
    {
        parent::__construct($request);
        $this->model = $frontendUsersAudit;
    }

    /**
     * @param array $inputDatas 接收的参数.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {

        $inputDatas['platformSign'] = $this->currentPlatformEloq->sign;
        $data                       = $this->model
            ->filter($inputDatas)
            ->select(
                [
                 'mobile',
                 'guid',
                 'order_number',
                 'type',
                 'amount',
                 'demand_bet',
                 'achieved_bet',
                 'status',
                 'created_at',
                 'achieved_time',
                ],
            )
            ->paginate($this->perPage);
        return msgOut($data);
    }
}
