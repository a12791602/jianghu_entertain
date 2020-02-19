<?php

namespace App\Http\Requests\Backend\Merchant\Finance\WithdrawOrder;

use App\Http\Requests\BaseFormRequest;
use App\Models\User\FrontendUser;
use App\Models\User\UsersWithdrawOrder;

/**
 * Class CheckIndexRequest
 * @package App\Http\Requests\Backend\Merchant\Finance\WithdrawOrder
 */
class CheckIndexRequest extends BaseFormRequest
{

    /**
     * @var array 需要依赖模型中的字段备注信息
     */
    protected $dependentModels = [
                                  UsersWithdrawOrder::class,
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
                   UsersWithdrawOrder::STATUS_CHECK_INIT,
                   UsersWithdrawOrder::STATUS_CHECK_PASS,
                   UsersWithdrawOrder::STATUS_CHECK_REFUSE,
                  ];
        $rules  = [
                   'order_no'     => 'string|min:1|max:128|exists:users_withdraw_orders,order_no',
                   'mobile'       => 'string|min:1|max:32|regex:/^1[345789]\d{9}$/', //匹配手机号
                   'guid'         => 'string|size:7',
                   'created_at'   => 'array',
                   'created_at.*' => 'required|date',
                   'status'       => 'integer|in:' . implode(',', $status),
                   'reviewer'     => 'string|min:1|max:32',
                   'review_at'    => 'array',
                   'review_at.*'  => 'required|date',
                   'is_audit'     => 'integer|in:0,1',
                  ];
        return $rules;
    }

    /**
     * @return mixed[]
     */
    public function filters(): array
    {
        return [
                'created_at' => 'cast:array',
                'review_at'  => 'cast:array',
               ];
    }
}
