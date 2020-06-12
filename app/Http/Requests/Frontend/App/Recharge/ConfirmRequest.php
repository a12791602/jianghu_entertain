<?php

namespace App\Http\Requests\Frontend\App\Recharge;

use App\Http\Requests\BaseFormRequest;
use App\Models\User\UsersRechargeOrder;

/**
 * Class ConfirmRequest
 * @package App\Http\Requests\Frontend\App\Recharge
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
        return ['order_no' => 'required|string|min:1|max:128|exists:users_recharge_orders,order_no'];
    }
}
