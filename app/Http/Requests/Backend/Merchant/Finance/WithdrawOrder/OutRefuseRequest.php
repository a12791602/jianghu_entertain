<?php

namespace App\Http\Requests\Backend\Merchant\Finance\WithdrawOrder;

use App\Http\Requests\BaseFormRequest;

/**
 * Class OutRefuseRequest
 * @package App\Http\Requests\Backend\Merchant\Finance\WithdrawOrder
 */
class OutRefuseRequest extends BaseFormRequest
{
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
