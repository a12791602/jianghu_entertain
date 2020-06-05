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
     * @var array 自定义字段 【此字段在数据库中没有的字段字典】
     */
    protected $extraDefinition = [
                                  'card_number'   => '银行卡号',
                                  'branch'        => '支行',
                                  'bank'          => '银行',
                                  'top_up_remark' => '备注',
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
        return [
                'is_online'     => 'required|integer|in:0,1',
                'branch'        => 'required_if:is_online,0|string|max:30',
                'bank'          => 'required_if:is_online,0|string|max:30',
                'card_number'   => 'required_if:is_online,0|digits_between:13,19',
                'top_up_remark' => 'string|max:50',
                'order_no'      => 'required|string|min:1|max:128|exists:users_recharge_orders,order_no',
               ];
    }
}
