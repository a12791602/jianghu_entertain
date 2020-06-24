<?php

namespace App\Http\Requests\Backend\Merchant\Finance\WithdrawOrder;

use App\Http\Requests\BaseFormRequest;
use App\Models\User\FrontendUser;
use App\Models\User\FrontendUsersWithdrawOrder;

/**
 * Class OutIndexRequest
 * @package App\Http\Requests\Backend\Merchant\Finance\WithdrawOrder
 */
class OutIndexRequest extends BaseFormRequest
{

    /**
     * @var array 需要依赖模型中的字段备注信息
     */
    protected $dependentModels = [
                                  FrontendUsersWithdrawOrder::class,
                                  FrontendUser::class,
                                 ];

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return boolean
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return mixed[]
     */
    public function rules(): array
    {
        $status = [
                   FrontendUsersWithdrawOrder::STATUS_CHECK_PASS,
                   FrontendUsersWithdrawOrder::STATUS_OUT_SUCCESS,
                   FrontendUsersWithdrawOrder::STATUS_OUT_REFUSE,
                  ];
        $type   = [
                   FrontendUsersWithdrawOrder::TYPE_BANK,
                   FrontendUsersWithdrawOrder::TYPE_ALIPAY,
                   FrontendUsersWithdrawOrder::TYPE_WECHAT,
                  ];
        return [
                'order_no'       => 'string|min:1|max:128|exists:frontend_users_withdraw_orders,order_no',
                'mobile'         => 'string|min:1|max:32|regex:/^1[345789]\d{9}$/', //(手机号码第一位1第二位345789总共11位数字)
                'guid'           => 'string|size:7',
                'account_type'   => 'integer|in:' . implode(',', $type),
                'status'         => 'integer|in:' . implode(',', $status),
                'is_audit'       => 'integer|in:0,1',
                'admin'          => 'string|min:1|max:32',
                'operation_at'   => 'array',
                'operation_at.*' => 'required|date',
                'pageSize'       => 'integer|between:1,100',     //每页数据条数
               ];
    }

    /**
     * @return mixed[]
     */
    public function filters(): array
    {
        return ['operation_at' => 'cast:array'];
    }
}
