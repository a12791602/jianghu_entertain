<?php

namespace App\Http\Requests\Frontend\H5\Recharge;

use App\Http\Requests\BaseFormRequest;
use App\Models\Order\UsersRechargeOrder;

/**
 * Class ConfirmRequest
 * @package App\Http\Requests\Frontend\H5\Recharge
 */
class ConfirmRequest extends BaseFormRequest
{

    /**
     * @var array 需要依赖模型中的字段备注信息
     */
    protected $dependentModels = [UsersRechargeOrder::class];

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
                'order_no'      => 'required|string|min:1|max:128|exists:users_recharge_orders,order_no',
                'branch'        => 'required_if:is_online,0|string|max:30',
                'bank'          => 'required_if:is_online,0|string|max:30',
                'card_number'   => 'required_if:is_online,0|digits_between:13,19',
                'top_up_remark' => 'string|max:50',
               ];
    }
}
