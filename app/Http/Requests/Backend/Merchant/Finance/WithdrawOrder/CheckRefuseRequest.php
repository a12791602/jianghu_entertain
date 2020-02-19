<?php

namespace App\Http\Requests\Backend\Merchant\Finance\WithdrawOrder;

use App\Http\Requests\BaseFormRequest;
use App\Models\User\UsersWithdrawOrder;

/**
 * Class CheckRefuseRequest
 * @package App\Http\Requests\Backend\Merchant\Finance\WithdrawOrder
 */
class CheckRefuseRequest extends BaseFormRequest
{

    /**
     * @var array 需要依赖模型中的字段备注信息
     */
    protected $dependentModels = [UsersWithdrawOrder::class];

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
                'id'     => 'required|integer|min:1|exists:users_withdraw_orders,id',
                'remark' => 'string|min:1|max:256',
               ];
    }
}
