<?php

namespace App\Http\Requests\Backend\Merchant\Finance\WithdrawOrder;

use App\Http\Requests\BaseFormRequest;
use App\Models\User\FrontendUsersWithdrawOrder;

/**
 * Class OutSuccessRequest
 * @package App\Http\Requests\Backend\Merchant\Finance\WithdrawOrder
 */
class OutSuccessRequest extends BaseFormRequest
{

    /**
     * @var array 需要依赖模型中的字段备注信息
     */
    protected $dependentModels = [FrontendUsersWithdrawOrder::class];

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
        return [
                'id'     => 'required|integer|min:1|exists:frontend_users_withdraw_orders,id',
                'remark' => 'string|min:1|max:256',
               ];
    }
}
