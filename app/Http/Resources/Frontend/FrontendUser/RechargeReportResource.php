<?php

namespace App\Http\Resources\Frontend\FrontendUser;

use App\Http\Resources\BaseResource;

/**
 * Class RechargeReportResource
 * @package App\Http\Resources\Backend\Headquarters\Game\GameType
 */
class RechargeReportResource extends BaseResource
{

    /**
     * @var string $order_no 管理员Id.
     */
    private $order_no;

    /**
     * @var float $money 订单金额.
     */
    private $money;

    /**
     * @var float $arrive_money 实际到账金额.
     */
    private $arrive_money;

    /**
     * @var integer $recharge_status 支付状态.
     */
    private $recharge_status;

    /**
     * @var integer $status 审核状态.
     */
    private $status;

    /**
     * @var \App\Models\Finance\SystemFinanceType $financeType 资金类型.
     */
    private $financeType;

    /**
     * @var \Carbon\Carbon $created_at 充值时间.
     */
    private $created_at;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request Request.
     * @return mixed[]
     */
    public function toArray($request): array
    {
        unset($request);
        return [
                'order_no'          => $this->order_no,
                'money'             => $this->money,
                'arrive_money'      => $this->arrive_money,
                'recharge_status'   => $this->recharge_status,
                'status'            => $this->status,
                'finance_type_name' => $this->financeType->name ?? '',
                'created_at'        => $this->created_at->toDateTimeString(),
               ];
    }
}
